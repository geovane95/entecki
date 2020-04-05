<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    private $city,$state;
    public function __construct(City $city, State $state)
    {
        $this->city = $city;
        $this->state = $state;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(request()->ajax())
        {
            $data = $this->city->get();
            return DataTables::of($data)
                ->addColumn('status-desc', function ($data) {
                    $sta = $data->status == 1 ? 'Ativo' : 'Inativo';
                    return $sta;
                })
                ->addColumn('state-name',function($data){
                    $stat = $this->state->find($data->state);
                    return $stat->name;
                })
                ->addColumn('action',function($data){
                    $button = "<button type='button'
                    name='edit' id='{$data->id}'
                    class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .="<button type='button'
                    name='delete' id='{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action','responsible'])
                ->make(true);
        }

        $state = Arr::pluck($this->state->get()->where('status', '=', 1), 'name', 'id');
        return view('administrativo.city.index', ['state' => $state]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityRequest $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $datForm = [
            'name' => $request->name,
            'state' => $request->state,
            'status' => $request->status
        ];

        $city = $this->city->create($datForm);

        if (!$city)
            return response()->json(['error'=>'Falha ao criar uma cidade.', 500]);

        return response()->json(['success'=>true],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $city = $this->city->find($id);

        if (!$city)
            return response()->json(['error'=>'Falha ao buscar a cidade'],500);

        return response()->json([$city],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $city = $this->city->find($id);

        if (!$city)
            return response()->json(['error'=>'Falha ao buscar a cidade'],500);

        return response()->json([$city],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(CityRequest $request, $id)
    {
        $city = $this->city->find($id);

        if (!$city)
            return response()->json(['error'=>'Falha ao buscar a cidade'],500);

        $datForm = [
            "name" => $request->name,
            "state" => $request->state,
            "status" => $request->status
        ];

        if(!$this->city->update($datForm))
            return response()->json(["error" => "Dados de Cidade não encontrados!"], 500);

        return response()->json(["success" => true], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $city = $this->city->find($id);

        if (!$city)
            return response()->json(['error'=>'Falha ao buscar a cidade'],500);

        return response()->json(['success' => true],200);
    }
}
