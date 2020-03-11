<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StateRequest;
use App\Models\State;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class StateController extends Controller
{
    private $state;
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        $data =  $this->state->get();

        if(request()->ajax())
        {
            return DataTables::of($data)
                ->addColumn('action',function($data){
                    $button = "<button type='button'
                    name='edit' id='{$data->id}'
                    class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .="<button type='button'
                    name='delete' id='{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('administrativo.state.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StateRequest $request
     * @return JsonResponse
     */
    public function store(StateRequest $request)
    {
        $datForm = [
            'name' => $request->name,
            'initials' => $request->initials,
            'status' => $request->status
        ];

        $state = $state = $this->state->create($datForm);

        if (!$state)
            return response()->json(['error'=>'Falha ao criar um estado.', 500]);

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
        $state = $this->state->find($id);

        if (!$state)
            return response()->json(['error'=>'Falha ao buscar um estado'],500);

        return response()->json([$state],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $state = $this->state->find($id);

        if (!$state)
            return response()->json(['error'=>'Falha ao buscar um estado'],500);

        return response()->json([$state],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StateRequest $request, $id)
    {
        $state = $this->state->find($id);

        if (!$state)
            return response()->json(['error'=>'Falha ao buscar o estado'],500);

        $datForm = [
            "name" => $request->name,
            "initials" => $request->initials,
            "status" => $request->status
        ];

        if(!$this->state->update($datForm))
            return response()->json(["error" => "Dados de estado não alterados!"], 500);

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
        $state = $this->state->find($id);

        if (!$state)
            return response()->json(['error'=>'Falha ao buscar a cidade'],500);

        return response()->json(['success' => true],200);
    }

    public function stateCity($id)
    {
        $cities = $this->state->find($id)->cities;

        return response()->json($cities);
    }
}
