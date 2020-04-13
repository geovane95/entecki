<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompetenceRequest;
use App\Models\Competence;
use App\Models\Data;
use App\Models\UploadData;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CompetenceController extends Controller
{
    private $competence;

    public function __construct(Competence $competence)
    {
        $this->competence = $competence;
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
            $data = $this->competence->get();
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
        return view('administrativo.competence.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CompetenceRequest $request)
    {
        $months = [
            1 => 'JAN',
            2 => 'FEV',
            3 => 'MAR',
            4 => 'ABR',
            5 => 'MAI',
            6 => 'JUN',
            7 => 'JUL',
            8 => 'AGO',
            9 => 'SET',
            10 => 'OUT',
            11 => 'NOV',
            12 => 'DEZ'
        ];
        $description = $months[$request->month] . '/' . $request->year;
        $datForm = [
            'month' => $request->month,
            'year' => $request->year,
            'description' => $description,
            'status' => $request->status
        ];

        $competence = $this->competence->create($datForm);

        if (!$competence)
            return response()->json(['error' => 'Falha ao criar um mês de referência.', 500]);

        return response()->json(['success' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $competence = $this->competence->find($id);

        if (!$competence)
            return response()->json(['error' => 'Falha ao buscar a cidade'], 500);

        return response()->json([$competence], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $competence = $this->competence->find($id);

        if (!$competence)
            return response()->json(['error' => 'Falha ao buscar a cidade'], 500);

        return response()->json([$competence], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $competence = $this->competence->find($id);

        if (!$competence)
            return response()->json(['error' => 'Falha ao buscar o mês de referencia'], 500);

        $months = [
            1 => 'JAN',
            2 => 'FEV',
            3 => 'MAR',
            4 => 'ABR',
            5 => 'MAI',
            6 => 'JUN',
            7 => 'JUL',
            8 => 'AGO',
            9 => 'SET',
            10 => 'OUT',
            11 => 'NOV',
            12 => 'DEZ'
        ];
        $description = $months[$request->month] . '/' . $request->year;
        $datForm = [
            'month' => $request->month,
            'year' => $request->year,
            'description' => $description,
            'status' => $request->status
        ];

        if (!$competence->update($datForm))
            return response()->json(["error" => "Dados não encontrados!"], 500);

        return response()->json(["success" => true], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $competence = $this->competence->find($id);

            if (!$competence)
                return response()->json(['error' => 'Falha ao excluir o mês de referência'], 500);

            $uplodadatas = UploadData::where('competence', '=', $competence->id)->get();

            foreach ($uplodadatas as $uplodadata) {
                $ud = UploadData::find($uplodadata->id);
                if ($ud->uploadtype == 1) {
                    $datas = Data::where('uploaddata', '=', $ud->id)->get();
                    foreach ($datas as $data) {
                        $dt = Data::find($data->id);
                        $dt->delete();
                    }
                }
                $ud->delete();
            }

            $competence->delete();

            return response()->json(['success'=>'success'],204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao excluir o mês de referência, ouve um erro na tentativa de deletar as associações.'], 500);
        }
    }
}
