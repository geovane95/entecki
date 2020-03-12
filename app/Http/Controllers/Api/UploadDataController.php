<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ConstructionImport;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\AccessProfile;
use App\Models\UploadData;
use App\Models\UploadStatus;
use App\Models\UploadType;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use function foo\func;

class UploadDataController extends Controller
{
    private $uploaddata, $construction, $user, $accessprofile, $uploadstatus, $uploadtype, $data, $competence;

    public function __construct(
        UploadData $uploaddata,
        Construction $construction,
        User $user,
        AccessProfile $accessprofile,
        UploadStatus $uploadstatus,
        UploadType $uploadtype,
        Data $data,
        Competence $competence
    )
    {
        $this->uploaddata = $uploaddata;
        $this->construction = $construction;
        $this->user = $user;
        $this->accessprofile = $accessprofile;
        $this->uploadstatus = $uploadstatus;
        $this->uploadtype = $uploadtype;
        $this->data = $data;
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
            $data = $this->uploaddata->get();

            return DataTables::of($data)
                ->addColumn('upload_type_name', function ($data) {
                    $ut = $this->uploadtype->find($data->uploadtype);
                    return $ut->name;
                })
                ->addColumn('user_name', function ($data) {
                    $us = $this->user->find($data->user);
                    return $us->name;
                })
                ->addColumn('competence_description', function ($data) {
                    $comp = $this->competence->find($data->competence);
                    return $comp->description;
                })
                ->addColumn('upload_status_name', function ($data) {
                    $ust = $this->uploadstatus->find($data->uploadstatus);
                    return $ust->name;
                })
                ->addColumn('action', function ($data){
                    $button = '<a href="'.route("download",$data->file).'" class="btn btn-info">Download</a>';

                    return $button;
                })
                ->make(true);
        }

        $competence = Arr::pluck($this->competence->get()->where('status', '=', 1), 'description', 'id');
        $uploadtype = Arr::pluck($this->uploadtype->get()->where('status', '=', 1), 'name', 'id');
        $construction = Arr::pluck($this->construction->get()->where('status', '=', 1), 'name', 'id');
        return view('administrativo.upload_data.index', ['competence' => $competence, 'uploadtype' => $uploadtype, 'construction' => $construction]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $file = false;
        $extension = '';
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $file = $request->file->storeAs('uploads/'.$request->competence, $nameFile);
        }

        $u = $this->user->find(auth()->user()->id);
        $datForm = [
            'user' => $u->id,
            'accessprofile' => $u->access_profile,
            'uploadstatus' => 1,
            'uploadtype' => $request->upload_type,
            'competence' => $request->competence,
            'linecount' => 0,
            'fileName' => $request->file->getClientOriginalName(),
            'file' => $file,
            'extension' => $extension,
            'folder' => 'uploads/'.$request->competence.'/',
            'construction' => $request->construction ? $request->construction : 0,
        ];
        $upload_data = $this->uploaddata->create($datForm);

        switch ($request->upload_type){
            case 1: //Import de informações da obra;
                $response = Excel::import(new ConstructionImport($request->competence, $upload_data), $file);
                if ($response)
                    return redirect(route('upload_data.index'))->withSuccess('Upload de informações efetuado com Sucesso !');
                else
                    return redirect(route('upload_data.index'))->withErrors('Upload Falhou');
                break;
            case 2:
            case 3:
                $upload_data->uploadstatus = 2;
                $upload_data->update();
                if ($upload_data)
                    return redirect(route('upload_data.index'))->withSuccess('Upload realizado efetuado com Sucesso !');
                else
                    return redirect(route('upload_data.index'))->withErrors('Upload Falhou');

                break;
            default:
                return redirect(route('upload_data.index'))->withErrors('Upload Falhou: Opção de Dados indisponível');
                break;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
