<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ConstructionRequest;
use App\Models\Data;
use App\Models\Regional;
use App\Models\UploadData;
use App\Models\UsersToConstructions;
use Exception;
use App\Models\City;
use App\Models\State;
use App\Models\Address;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Business;
use Illuminate\Support\Arr;
use App\Models\Construction;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;

/**
 * @method with(array $array)
 */
class ConstructionController extends Controller
{
    private $construction, $business, $regional, $address, $location, $state, $city, $upload_data, $usersToConstructions;

    public function __construct(
        Construction $construction,
        Business $business,
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
        $this->business = $business;
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
                ->addColumn('business-name', function ($data) {
                    $buss = $this->business->find($data->business);
                    return $buss->name;
                })
                ->addColumn('regional-name', function ($data) {
                    $reg = $this->regional->find($data->regional);
                    return $reg->name;
                })
                ->addColumn('status-desc', function ($data) {
                    $sta = $data->status == 1 ? 'Ativo' : 'Inativo';
                    return $sta;
                })
                ->addColumn('picture', function ($data) {
                    $strThumbnail = '';
                    if ($data->thumbnail) {
                        $strThumbnail = '<img src="' . url('storage/',$data->thumbnail) . '" class="thumbnail" style="width: 50px;" id="'.$data->id.'"/>';
                    } else {
                        $strThumbnail = "<button type='button'
                        name='thumbnail' id='{$data->id}'
                        class='thumbnail  btn btn-danger btn-sm ml-2'>Inserir Foto</button>";
                    }
                    return $strThumbnail;
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
                    if ($users && count($users) > 0) {
                        foreach ($users as $user) {
                            if ($first) {
                                $first = false;
                            } else {
                                $retorno .= ', ';
                            }
                            $retorno .= $user->username;
                        }
                    } else {
                        $retorno .= "Esta obra não possui usuários atrelados ainda.";
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
                    name='cliente' id='{$data->id}'
                    class='cliente btn btn-warning btn-sm ml-2'>Usuários</a>";

                    return $button;
                })->rawColumns(['action', 'picture'])
                ->make(true);
        }

        $state = Arr::pluck($this->state->get()->where('status', '=', 1), 'name', 'id');
        $city = Arr::pluck($this->city->get()->where('status', '=', 1), 'name', 'id');
        $business = Arr::pluck($this->business->get()->where('status', '=', 1), 'name', 'id');
        $regional = Arr::pluck($this->regional->get()->where('status', '=', 1), 'name', 'id');
        return view('administrativo.construction.index', ['state' => $state, 'city' => $city, 'business' => $business, 'regional' => $regional]);
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
            /*$thumbnail = false;
            if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->thumbnail->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $thumbnail = $request->thumbnail->storeAs('constructions', $nameFile);
            }*/

            $formCpnj = $request->cnpj;
            $formCpnj = str_replace('.', '', str_replace('/', '', str_replace('-', '', $formCpnj)));
            $datForm = [
                'name' => $request->name,
                //'thumbnail' => $thumbnail,
                'company' => $request->company,
                'responsible' => $request->responsible,
                'cnpj' => $formCpnj,
                'business' => $request->business,
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
        $construction = $this->construction->with(['business', 'regionals', 'address'])->find($id);
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
        $construction = $this->with(['business', 'regional', 'address'])->construction->find($id);

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

        if ($location->update($dataLocation)) {

            $dataAddress = [
                "street" => $request->street,
                "number" => $request->number,
                "location" => $location->id,
                "status" => $request->status
            ];

            if ($address->update($dataAddress)) {

                $formCpnj = $request->cnpj;
                $formCpnj = str_replace('.', '', str_replace('/', '', str_replace('-', '', $formCpnj)));
                $datForm = [
                    'name' => $request->name,
                    'company' => $request->company,
                    'responsible' => $request->responsible,
                    'cnpj' => $formCpnj,
                    'business' => $request->business,
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

        if ($construction) {
            $idAddress = $construction->address;

            $address = $this->address->find($idAddress);

            $idLocation = $address->location;

            $location = $this->location->find($idLocation);

            $datas = Data::where('construction', '=', $construction->id);

            foreach ($datas as $data) {
                $data->delete();
            }

            $userstoconstructions = DB::table('users_to_constructions')->where("construction", "=", $construction->id)->get();

            foreach ($userstoconstructions as $uc) {
                DB::delete("delete from users_to_constructions where id = " . $uc->id);
            }

            $uploads = DB::table('upload_data')->where("construction", "=", $construction->id)->get();

            foreach ($uploads as $upload) {
                DB::delete("delete from upload_data where id = " . $upload->id);
                DB::delete("delete from data where uploaddata = " . $upload->id);
            }

            if ($construction->delete()) {
                if ($address->delete()) {
                    if ($location->delete()) {

                        return response()->json(["success" => "Obra deletada com sucesso"], 201);
                    }
                }
            }
        } else {
            return response()->json(["error" => "Falha na exclusão do status da obra!\nObra não encontrada"], 500);
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

    public function updateThumbnail(Request $request, $id)
    {
        $construction = $this->construction->find($id);

        if (!$construction)
            return response()->json(['error' => 'Fail to find Contruction'], 500);

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

            $construction->thumbnail = $thumbnail;
            $construction->save();
            return response()->json(['success' => true], 201);
        }else {
            return response()->json(['error' => 'Fail to update Contruction'], 500);
        }
    }
}
