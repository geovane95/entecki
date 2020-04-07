<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BusinessRequest;
use App\Models\Business;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class BusinessController extends Controller
{
    private $business;
    public function __construct(Business $business)
    {
        $this->business = $business;
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
            $data = $this->business->get();
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
        return view('administrativo.business.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BusinessRequest $request
     * @return JsonResponse
     */
    public function store(BusinessRequest $request)
    {
        $datForm = [
            'name'=>$request->business_name,
            'status'=>$request->status
        ];

        $business = $this->business->create($datForm);

        if (!$business)
            return response()->json(['error'=>'Falha ao criar uma empresa.', 500]);

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
        $business = $this->business->find($id);

        if (!$business)
            return response()->json(['error'=>'Falha ao buscar empresa'],500);

        return response()->json([$business],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $business = $this->business->find($id);

        if (!$business)
            return response()->json(['error'=>'Falha ao buscar empresa'],500);

        return response()->json([$business],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BusinessRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(BusinessRequest $request, $id)
    {
        $business = $this->business->find($id);

        if (!$business)
            return response()->json(['error'=>'Falha ao buscar empresa'],500);

        $datForm = [
            'name'=>$request->business_name,
            'status'=>$request->status
        ];

        if (!$business->update($datForm))
            return response()->json(['error'=>'Falha na alteração do empresa'], 500);

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
        $business = $this->business->find($id);

        $business->status = 0;

        if (!$business->save())
            return response()->json(['error'=>'Falha ao buscar empresa'],500);

        return response()->json(['success' => true],204);
    }
}
