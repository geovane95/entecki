<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegionalRequest;
use App\Models\Regional;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RegionalController extends Controller
{
    private $regional;
    public function __construct(Regional $regional)
    {
        $this->regional = $regional;
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
            $data = $this->regional->get();
            return DataTables::of($data)
                ->addColumn('status-desc', function ($data) {
                    $sta = $data->status == 1 ? 'Ativo' : 'Inativo';
                    return $sta;
                })
                ->addColumn('action', function ($data) {
                    $button = "<button type='button'
                name='edit' id='{$data->id}'
                class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .= "<button type='button'
                name='delete' id='{$data->id}'
                class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('administrativo.regional.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(RegionalRequest $request)
    {
        $datForm = [
            'name'=>$request->name,
            'status'=>$request->status
        ];

        $regional = $this->regional->create($datForm);

        if (!$regional)
            return response()->json(['error'=>'Falha ao criar um regional.', 500]);

        return response()->json(['success' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $regional = $this->regional->find($id);

        if (!$regional)
            return response()->json(['error'=>'Falha ao buscar regional'],500);

        return response()->json([$regional],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(RegionalRequest $request, $id)
    {
        $regional = $this->regional->find($id);

        if (!$regional)
            return response()->json(['error'=>'Falha ao buscar regional'],500);

        $datForm = [
            'name'=>$request->name,
            'status'=>$request->status
        ];

        if (!$regional->update($datForm))
            return response()->json(['error'=>'Falha na alteração do Regional'], 500);

        return response()->json(['success'=>true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $regional = $this->regional->find($id);

        $regional->status = 0;

        if (!$regional->save())
            return response()->json(['error'=>'Falha ao buscar o regional'],500);

        return response()->json(['success' => true],204);
    }
}
