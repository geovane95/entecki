<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResponsibleRequest;
use App\Models\Responsible;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ResponsibleController extends Controller
{
    private $responsible;
    public function __construct(Responsible $responsible)
    {
        $this->responsible = $responsible;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = $this->responsible->get();
            return DataTables::of($data)
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
        return view('administrativo.responsible.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResponsibleRequest $request
     * @return JsonResponse
     */
    public function store(ResponsibleRequest $request)
    {
        $formCpnj = $request->cnpj;
        $formCpnj = str_replace('.','',str_replace('/','',str_replace('-','',$formCpnj)));
        $datForm = [
            'company_name'=>$request->company_name,
            'cnpj'=>$formCpnj,
            'status'=>$request->status
        ];

        $responsible = $this->responsible->create($datForm);

        if (!$responsible)
            return response()->json(['error'=>'Falha ao criar um responsavel.', 500]);

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
        $responsible = $this->responsible->find($id);

        if (!$responsible)
            return response()->json(['error'=>'Falha ao buscar responsável'],500);

        return response()->json([$responsible],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $responsible = $this->responsible->find($id);

        if (!$responsible)
            return response()->json(['error'=>'Falha ao buscar responsável'],500);

        return response()->json([$responsible],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResponsibleRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(ResponsibleRequest $request, $id)
    {
        $responsible = $this->responsible->find($id);

        if (!$responsible)
            return response()->json(['error'=>'Falha ao buscar responsável'],500);

        $datForm = [
            'company_name'=>$request->company_name,
            'cnpj'=>$request->cnpj,
            'status'=>$request->status
        ];

        if (!$this->responsible->update($datForm))
            return response()->json(['error'=>'Falha na alteração do Responsável'], 500);

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
        $responsible = $this->responsible->find($id);

        $responsible->status = 0;

        if (!$responsible->save())
            return response()->json(['error'=>'Falha ao buscar responsável'],500);

        return response()->json(['success' => true],204);
    }
}
