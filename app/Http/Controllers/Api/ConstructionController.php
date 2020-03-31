<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ConstructionRequest;
use App\Mail\SendConstructionMail;
use App\Models\Regional;
use App\Models\UploadData;
use App\Models\UsersToConstructions;
use Exception;
use App\Models\City;
use App\Models\State;
use App\Models\Address;
use App\Models\Location;
use http\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use App\Models\Responsible;
use Illuminate\Support\Arr;
use App\Models\Construction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Imports\ConstructionImport;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @method with(array $array)
 */
class ConstructionController extends Controller
{
    private $construction, $responsible, $regional, $address, $location, $state, $city, $upload_data, $usersToConstructions;

    public function __construct(
        Construction $construction,
        Responsible $responsible,
        Regional $regional,
        Address $address,
        Location $location,
        State $state,
        City $city,
        UploadData $upload_data,
        UsersToConstructions $usersToConstructions
    )
    {
        $this->construction = $construction;
        $this->responsible = $responsible;
        $this->regional = $regional;
        $this->address = $address;
        $this->location = $location;
        $this->state = $state;
        $this->city = $city;
        $this->upload_data = $upload_data;
        $this->usersToConstructions = $usersToConstructions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = $this->construction->get();
            return DataTables::of($data)
                ->addColumn('responsible-name', function ($data) {
                    $respons = $this->responsible->find($data->responsible);
                    return $respons->company_name;
                })
                ->addColumn('regional-name', function ($data) {
                    $reg = $this->regional->find($data->regional);
                    return $reg->name;
                })
                ->addColumn('users-name', function ($data) {
                    $users = DB::table('constructions')
                        ->join('users_to_constructions', 'users_to_constructions.construction', '=', 'constructions.id')
                        ->join('users', 'users.id', '=', 'users_to_constructions.user')
                        ->select(
                            'constructions.id',
                            'users.name as username',
                            'users.id as userid'
                        )
                        ->where('constructions.id', '=', $data->id)
                        ->get();
                    $retorno = '';
                    $first = true;
                    foreach ($users as $user) {
                        if ($first) {
                            $first = false;
                        } else {
                            $retorno .= ', ';
                        }
                        $retorno .= $user->username;
                    }
                    return $retorno;
                })
                ->addColumn('action', function ($data) {
                    $button = "<button type='button'
                    name='edit' id='{$data->id}'
                    class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .= "<button type='button'
                    name='delete' id='{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    $button .= "<a
                    name='cliente'
                    class='cliente btn btn-warning btn-sm ml-2' id='{$data->id}'>Usuários</a>";

                    return $button;
                })->rawColumns(['action'])
                ->make(true);
        }

        $state = Arr::pluck($this->state->get()->where('status', '=', 1), 'name', 'id');
        $city = Arr::pluck($this->city->get()->where('status', '=', 1), 'name', 'id');
        $responsible = Arr::pluck($this->responsible->get()->where('status', '=', 1), 'company_name', 'id');
        $regional = Arr::pluck($this->regional->get()->where('status', '=', 1), 'name', 'id');
        return view('administrativo.construction.index', ['state' => $state, 'city' => $city, 'responsible' => $responsible, 'regional' => $regional]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConstructionRequest $request
     * @return JsonResponse
     */
    public function store(ConstructionRequest $request)
    {
        $zipcode = str_replace('-', '', $request->zipCode);
        $dataLocation = [
            "neighborhood" => $request->neighborhood,
            "zipCode" => $zipcode,
            "city" => $request->city,
            "status" => $request->status
        ];

        $location = Location::create($dataLocation);

        $dataAddress = [
            "street" => $request->street,
            "number" => $request->number,
            "location" => $location->id,
            "status" => $request->status
        ];

        $address = Address::create($dataAddress);

        if ($address) {
            $thumbnail = false;
            if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->thumbnail->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $thumbnail = $request->thumbnail->storeAs('constructions', $nameFile);
            }
            $datForm = [
                'name' => $request->name,
                'thumbnail' => $thumbnail,
                'company' => $request->company,
                'responsible' => $request->responsible,
                'regional' => $request->regional,
                'address' => $address->id,
                'contract_regime' => $request->contract_regime,
                'reporting_regime' => $request->reporting_regime,
                'issuance_date' => $request->issuance_date,
                'work_number' => $request->work_number,
                'status' => $request->status
            ];

            $construction = $this->construction->create($datForm);


            if (!$construction)
                return response()->json(['error' => 'Falha ao tentar salvar a construção'], 500);
        }
        return response()->json(['success' => true, 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $construction = $this->construction->with(['responsibles', 'regionals', 'address'])->find($id);
        $address = $this->address->find($construction->address);
        $location = $this->location->find($address->location);
        $city = $this->city->find($location->city);
        $construction->location = $location;
        $construction->city = $city;

        if (!$construction)
            return response()->json(['error' => 'Falha ao buscar a construção'], 500);


        return response()->json($construction, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $construction = $this->with(['responsible', 'regional', 'address'])->construction->find($id);

        if (!$construction)
            return response()->json(['error' => 'Fail to find Contruction'], 500);


        return response()->json($construction, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConstructionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ConstructionRequest $request, $id)
    {
        $construction = $this->construction->find($id);
        $address = $this->address->find($construction->address);
        $location = $this->location->find($address->location);

        if (!$construction)
            return response()->json(['error' => 'Fail to find Contruction'], 500);

        $zipcode = str_replace('-', '', $request->zipCode);
        $dataLocation = [
            "neighborhood" => $request->neighborhood,
            "zipCode" => $zipcode,
            "city" => $request->city,
            "status" => $request->status
        ];

        if($location->update($dataLocation)) {

            $dataAddress = [
                "street" => $request->street,
                "number" => $request->number,
                "location" => $location->id,
                "status" => $request->status
            ];

            if ($address->update($dataAddress)) {

                $datForm = [
                    'name' => $request->name,
                    'company' => $request->company,
                    'responsible' => $request->responsible,
                    'regional' => $request->regional,
                    'address' => $address->id,
                    'contract_regime' => $request->contract_regime,
                    'reporting_regime' => $request->reporting_regime,
                    'issuance_date' => $request->issuance_date,
                    'work_number' => $request->work_number,
                    'status' => $request->status
                ];

                $thumbnail = false;
                if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                    // Define um aleatório para o arquivo baseado no timestamps atual
                    $name = uniqid(date('HisYmd'));

                    // Recupera a extensão do arquivo
                    $extension = $request->thumbnail->extension();

                    // Define finalmente o nome
                    $nameFile = "{$name}.{$extension}";
                    // Faz o upload:
                    $thumbnail = $request->thumbnail->storeAs('constructions', $nameFile);

                    $datForm['thumbnail'] = $thumbnail;
                }

                if (!$construction->update($datForm))
                    return response()->json(['error' => 'Fail to update Contruction'], 500);
            }
        }
        return response()->json(['success' => true], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $construction = $this->construction->find($id);

        if (!$construction) {
            $idAddress = $construction->address->id;

            $address = $this->address->find($idAddress);

            $idLocation = $address->location->id;

            $location = $this->location->find($idLocation);

            $location->status = 0;

            $this->location->save();

            $address->status = 0;

            $this->address->save();

            $construction->status = 0;

            $construction->save();

            return response()->json(["success" => "Obra inativada com sucesso"], 201);
        } else {
            return response()->json(["error" => "Falha na alteração do status da obra!"], 500);
        }
    }

    public function cities($id)
    {
        return Arr::pluck($this->city->where('state', '=', $id)->get(), 'name', 'id');

    }

    public function clientIndex(ConstructionRequest $request, $id)
    {

        $construction = $this->construction->with('clients')->find($id);
        if (!$construction)
            return redirect()->back();

        $clients = $construction->clients;

        return view('administrativo.construction.clients.index', ['construction' => $construction, 'clients' => $clients]);
    }

    public function users($id)
    {
        $users = DB::table('constructions')
            ->join('users_to_constructions', 'users_to_constructions.construction', '=', 'constructions.id')
            ->join('users', 'users.id', '=', 'users_to_constructions.user')
            ->select(
                'constructions.id',
                'users.name as username',
                'users.id as userid'
            )
            ->where('constructions.id', '=', $id)
            ->get();
        if (!$users)
            return redirect()->back();

        return response()->json($users);
    }

    public function addUser($id, $user)
    {
        $usertoconstruction = UsersToConstructions::where([
            'construction' => $id,
            'user' => $user
        ])->get();
        if (count($usertoconstruction) <= 0) {
            UsersToConstructions::create([
                'construction' => $id,
                'user' => $user
            ]);
        }

        $users = DB::table('constructions')
            ->join('users_to_constructions', 'users_to_constructions.construction', '=', 'constructions.id')
            ->join('users', 'users.id', '=', 'users_to_constructions.user')
            ->select(
                'constructions.id',
                'users.name as username',
                'users.id as userid'
            )
            ->where([
                'constructions.id' => $id,
                'users.id' => $user
            ])
            ->get();

        return response()->json($users);
    }

    public function removeUser($constructionId, $userId)
    {
        $usertoconstruction = $this->usersToConstructions->where([
            'user' => $userId,
            'construction' => $constructionId
        ])->get();

        if ($usertoconstruction) {
            $usertoconstruction = $usertoconstruction[0];

            $usertoconstruction->delete();
        }

        $users = DB::table('constructions')
            ->join('users_to_constructions', 'users_to_constructions.construction', '=', 'constructions.id')
            ->join('users', 'users.id', '=', 'users_to_constructions.user')
            ->select(
                'constructions.id',
                'users.name as username',
                'users.id as userid'
            )
            ->where('constructions.id', '=', $constructionId)
            ->get();

        return response()->json($users);
    }
}
