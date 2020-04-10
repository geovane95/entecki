<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ConstructionImport;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\AccessProfile;
use App\Models\DataAux;
use App\Models\UploadData;
use App\Models\UploadStatus;
use App\Models\UploadType;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
                ->addColumn('construction_name', function ($data) {
                    $name = "";
                    if ($data->construction != 0){
                        $const = $this->construction->find($data->construction);
                        $name = $const->name;
                    }
                    return $name;
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
                    $button = '<a href="'.url('storage/'.$data->file).'" target="_blank" class="btn btn-info btn-sm">Download</a>';
                    if (auth()->user()->access_profile == 1) {
                        $button .= '<button id="' . $data->id . '" class="btn btn-info btn-sm" onclick="deletar(' . $data->id . ')">Deletar</button>';
                    }
                    return $button;
                })
                ->make(true);
        }

        $qtdAprovs = count(UploadData::where('uploadstatus','=',4)->get());

        $competence = Arr::pluck($this->competence->get()->where('status', '=', 1), 'description', 'id');
        $uploadtype = Arr::pluck($this->uploadtype->get()->where('status', '=', 1), 'name', 'id');
        $construction = Arr::pluck($this->construction->get()->where('status', '=', 1), 'name', 'id');

        $data = [
            'competence' => $competence,
            'uploadtype' => $uploadtype,
            'construction' => $construction,
        ];

        if (auth()->user()->access_profile == 1) {
            $data['aprovs'] = $qtdAprovs;
        }

        return view('administrativo.upload_data.index', $data);
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
            $file = $request->file->storeAs('storage/uploads/'.$request->competence, $nameFile);
        }

        $u = $this->user->find(auth()->user()->id);

        $datForm = [
            'user' => $u->id,
            'accessprofile' => $u->access_profile,
            'uploadstatus' => 1,
            'uploadtype' => $request->uploadtype,
            'competence' => $request->competence,
            'linecount' => 0,
            'fileName' => $request->file->getClientOriginalName(),
            'file' => $file,
            'extension' => $extension,
            'folder' => 'uploads/'.$request->competence.'/',
            'construction' => $request->construction ? $request->construction : 0,
        ];
        $upload_data = $this->uploaddata->create($datForm);

        switch ($request->uploadtype){
            case 1: //Import de informações da obra;
                $response = Excel::import(new ConstructionImport($request->competence, $upload_data), $file);
                if ($response)
                    return redirect(route('upload_data.index'))->withSuccess('Upload de informações efetuado com Sucesso !');
                else
                    return redirect(route('upload_data.index'))->withErrors('Upload Falhou');
                break;
            case 2:
            case 3:
            case 4:
                if (auth()->user()->access_profile != 1) {
                    $upload_data->uploadstatus = 4;
                }else{
                    $upload_data->uploadstatus = 2;
                }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $uploadData = $this->uploaddata->find($id);

        if ($uploadData->uploadtype = 1){
            $datas = $this->data->where(['uploaddata' => $uploadData->id]);
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Storage::delete('public/'.$uploadData->file);
        if($uploadData->delete()){
            return response()->json(["success" => "Arquivo deletado com sucesso"], 201);
        } else {
            return response()->json(["error" => "Falha ao tentar deletar!"], 500);
        }
    }

    public function approve($id){

        try {
            $uploaddata = UploadData::find($id);

            $contador = 0;

            if ($uploaddata->uploadtype == 1) {

                $datas = DataAux::where('uploaddata', '=', $uploaddata->id)->get();

                foreach ($datas as $data) {
                    $data = [
                        'construction' => $data->construction,
                        'uploaddata' => $data->uploaddata,
                        'DATAEMISSAO' => $data->DATAEMISSAO,
                        'CUSTOP' => $data->CUSTOP,
                        'PRAZO' => $data->PRAZO,
                        'FLUXOD' => $data->FLUXOD,
                        'QUALIDADE' => $data->QUALIDADE,
                        'SEGORG' => $data->SEGORG,
                        'MAMBI' => $data->MAMBI,
                        'ACUMCONTR' => $data->ACUMCONTR,
                        'FASE' => $data->FASE,
                        'AREACONSTRM2' => $data->AREACONSTRM2,
                        'NUNITQTD' => $data->NUNITQTD,
                        'CORPRRATUAL' => $data->CORPRRATUAL,
                        'CORRPRATUALFAROL' => $data->CORRPRATUALFAROL,
                        'CORRPRATUALVLR' => $data->CORRPRATUALVLR,
                        'FXDPRRATUAL' => $data->FXDPRRATUAL,
                        'FXDRPRATUALFAROL' => $data->FXDRPRATUALFAROL,
                        'FXDRPRATUALVLR' => $data->FXDRPRATUALVLR,
                        'FPRPRFAROL' => $data->FPRPRFAROL,
                        'FPRPR' => $data->FPRPR,
                        'POTEROBRARPMESFAROL' => $data->POTEROBRARPMESFAROL,
                        'POTEROBRARPMES' => $data->POTEROBRARPMES,
                        'POECOPR' => $data->POECOPR,
                        'IDQFAROL' => $data->IDQFAROL,
                        'IDSFAROL' => $data->IDSFAROL,
                        'PORCCONTRATINDIC' => $data->PORCCONTRATINDIC,
                        'ACORCPROOJATUAL' => $data->ACORCPROOJATUAL,
                        'APORCPROOJATUAL' => $data->APORCPROOJATUAL,
                        'FBP' => $data->FBP,
                        'FBR' => $data->FBR,
                        'FBD' => $data->FBD,
                        'FOP' => $data->FOP,
                        'FOR' => $data->FOR,
                        'FOD' => $data->FOD,
                        'FOBP' => $data->FOBP,
                        'FOBR' => $data->FOBR,
                        'FOBD' => $data->FOBD,
                        'AREATERRENO' => $data->AREATERRENO,
                        'AREACONSTRUIDA' => $data->AREACONSTRUIDA,
                        'AREAPRIVATIVA' => $data->AREAPRIVATIVA,
                        'AREAEQUIVNB' => $data->AREAEQUIVNB,
                        'AREADEGARGAGEM' => $data->AREADEGARGAGEM,
                        'EFECIEPROJ' => $data->EFECIEPROJ,
                        'TIPOEMPREEND' => $data->TIPOEMPREEND,
                        'SISTCONSTRUTIVO' => $data->SISTCONSTRUTIVO,
                        'NDETORRESPVTOS' => $data->NDETORRESPVTOS,
                        'NPVTOSGARGAGEM' => $data->NPVTOSGARGAGEM,
                        'NUNIDADES' => $data->NUNIDADES,
                        'AREAAPARTAMENTOS' => $data->AREAAPARTAMENTOS,
                        'AGENTEFINANCEIRO' => $data->AGENTEFINANCEIRO,
                        'DATAVISTORIA' => $data->DATAVISTORIA,
                        'VALORFINANCIAMENTO' => $data->VALORFINANCIAMENTO,
                        'ORCCONTRATUAL' => $data->ORCCONTRATUAL,
                        'CUSTORASOOBRA' => $data->CUSTORASOOBRA,
                        'TAXAADM' => $data->TAXAADM,
                        'CUSTORASOTAXA' => $data->CUSTORASOTAXA,
                        'MANUTENCAO' => $data->MANUTENCAO,
                        'CUSTOSDIVERSOS' => $data->CUSTOSDIVERSOS,
                        'ORCCONTRATUALINCC' => $data->ORCCONTRATUALINCC,
                        'CUSTORASOOBRAINCC' => $data->CUSTORASOOBRAINCC,
                        'TAXAADMINCC' => $data->TAXAADMINCC,
                        'CUSTORASOTAXAINCC' => $data->CUSTORASOTAXAINCC,
                        'MANUTENCAOINCC' => $data->MANUTENCAOINCC,
                        'CUSTOSDIVERSOSINCC' => $data->CUSTOSDIVERSOSINCC,
                        'INICIOPLANOBRAPREV' => $data->INICIOPLANOBRAPREV,
                        'TERMPLANOBRAPREV' => $data->TERMPLANOBRAPREV,
                        'TERMHABITESEPREV' => $data->TERMHABITESEPREV,
                        'TERMCLIENTEPREV' => $data->TERMCLIENTEPREV,
                        'PRAZOBRAMESESPREV' => $data->PRAZOBRAMESESPREV,
                        'INICIOPLANOBRAREAL' => $data->INICIOPLANOBRAREAL,
                        'TERMPLANOBRAREAL' => $data->TERMPLANOBRAREAL,
                        'TERMHABITESEREAL' => $data->TERMHABITESEREAL,
                        'TERMCLIENTEREAL' => $data->TERMCLIENTEREAL,
                        'PRAZOOBRAMESESREAL' => $data->PRAZOOBRAMESESREAL,
                        'INICIOPLANOBRADESV' => $data->INICIOPLANOBRADESV,
                        'TERMPLANOBRADESV' => $data->TERMPLANOBRADESV,
                        'TERMHABITESEDESV' => $data->TERMHABITESEDESV,
                        'TERMCLIENTEDESV' => $data->TERMCLIENTEDESV,
                        'PRAZOOBRAMESESDESV' => $data->PRAZOOBRAMESESDESV,
                        'INICIOPLANOBRAFAROL' => $data->INICIOPLANOBRAFAROL,
                        'TERMPLANOBRAFAROL' => $data->TERMPLANOBRAFAROL,
                        'TERMHABITESEFAROL' => $data->TERMHABITESEFAROL,
                        'TERMCLIENTEFAROL' => $data->TERMCLIENTEFAROL,
                        'PRAZOOBRAMESESFAROL' => $data->PRAZOOBRAMESESFAROL,
                        'EVOORCID' => $data->EVOORCID,
                        'EVOORCINIOBRA' => $data->EVOORCINIOBRA,
                        'EVOORCADTV' => $data->EVOORCADTV,
                        'EVOORCREVOBRA' => $data->EVOORCREVOBRA,
                        'EVOORCIDINCC' => $data->EVOORCIDINCC,
                        'EVOORCINIOBRAINCC' => $data->EVOORCINIOBRAINCC,
                        'EVOORCADTVINCC' => $data->EVOORCADTVINCC,
                        'EVOORCREVOBRAINCC' => $data->EVOORCREVOBRAINCC,
                        'ACOFACUMTOTAL' => $data->ACOFACUMTOTAL,
                        'ACOFSALDOREAL' => $data->ACOFSALDOREAL,
                        'ACOFPROJCUSTO' => $data->ACOFPROJCUSTO,
                        'ACOFVARORCREV' => $data->ACOFVARORCREV,
                        'ACOFACUMTOTALINCC' => $data->ACOFACUMTOTALINCC,
                        'ACOFSALDOREALINCC' => $data->ACOFSALDOREALINCC,
                        'ACOFPROJCUSTOINCC' => $data->ACOFPROJCUSTOINCC,
                        'ACOFVARORCREVINCC' => $data->ACOFVARORCREVINCC,
                        'ACOFVARORCREVVALOR' => $data->ACOFVARORCREVVALOR,
                        'ACOFVARORCREVFAROL' => $data->ACOFVARORCREVFAROL,
                        'ACOFINCCIN' => $data->ACOFINCCIN,
                        'CUSTOM2PROJCONST' => $data->CUSTOM2PROJCONST,
                        'CUSTOM2PROJPRIVA' => $data->CUSTOM2PROJPRIVA,
                        'CUSTOM2PROJCONSTINCC' => $data->CUSTOM2PROJCONSTINCC,
                        'CUSTOM2PROJPRIVAINCC' => $data->CUSTOM2PROJPRIVAINCC,
                        'PROJEXEC' => $data->PROJEXEC,
                        'FUNDACAOTORRE' => $data->FUNDACAOTORRE,
                        'ESTRUTURATORRE' => $data->ESTRUTURATORRE,
                        'INSTALACOES' => $data->INSTALACOES,
                        'ACABAMENTO' => $data->ACABAMENTO,
                        'REVFACHADA' => $data->REVFACHADA,
                        'AEPAISAGISMO' => $data->AEPAISAGISMO,
                        'flamemeses' => $data->flamemeses,
                        'flameperiodofisprev' => $data->flameperiodofisprev,
                        'flameperiodofisprevmesatual' => $data->flameperiodofisprevmesatual,
                        'flameacumulofisreal' => $data->flameacumulofisreal,
                        'flameacumulofisprev' => $data->flameacumulofisprev,
                        'flameacumulofisproj' => $data->flameacumulofisproj,
                        'flameperiodofissubprev' => $data->flameperiodofissubprev,
                        'flameperiodofisproj' => $data->flameperiodofisproj,
                        'dfmeses' => $data->dfmeses,
                        'dfperiodofisprev' => $data->dfperiodofisprev,
                        'dfperiodofisprevmesatual' => $data->dfperiodofisprevmesatual,
                        'dfacumulofisreal' => $data->dfacumulofisreal,
                        'dfacumulofisprev' => $data->dfacumulofisprev,
                        'dfacumulofisproj' => $data->dfacumulofisproj,
                        'dfperiodofissubprev' => $data->dfperiodofissubprev,
                        'dfperiodofisproj' => $data->dfperiodofisproj,
                        'aaprevfisobra' => $data->aaprevfisobra,
                        'aarealfisobra' => $data->aarealfisobra,
                        'npprevfisobra' => $data->npprevfisobra,
                        'nprealfisobra' => $data->nprealfisobra,
                        'atprevfisobra' => $data->atprevfisobra,
                        'atrealfisobra' => $data->atrealfisobra,
                        'dtprevfisobra' => $data->dtprevfisobra,
                        'dtrealfisobra' => $data->dtrealfisobra,
                        'dtprevfisobrafarol' => $data->dtprevfisobrafarol,
                        'dtrealfisobrafarol' => $data->dtrealfisobrafarol,
                        'aaprevfisbanco' => $data->aaprevfisbanco,
                        'aarealfisbanco' => $data->aarealfisbanco,
                        'npprevfisbanco' => $data->npprevfisbanco,
                        'nprealfisbanco' => $data->nprealfisbanco,
                        'atprevfisbanco' => $data->atprevfisbanco,
                        'atrealfisbanco' => $data->atrealfisbanco,
                        'dtprevfisbanco' => $data->dtprevfisbanco,
                        'dtrealfisbanco' => $data->dtrealfisbanco,
                        'dtprevfisbancofarol' => $data->dtprevfisbancofarol,
                        'dtrealfisbancofarol' => $data->dtrealfisbancofarol,
                        'aaprevfinbanco' => $data->aaprevfinbanco,
                        'aarealfinbanco' => $data->aarealfinbanco,
                        'npprevfinbanco' => $data->npprevfinbanco,
                        'nprealfinbanco' => $data->nprealfinbanco,
                        'atprevfinbanco' => $data->atprevfinbanco,
                        'atrealfinbanco' => $data->atrealfinbanco,
                        'dtprevfinbanco' => $data->dtprevfinbanco,
                        'dtrealfinbanco' => $data->dtrealfinbanco,
                        'dtprevfinbancofarol' => $data->dtprevfinbancofarol,
                        'dtrealfinbancofarol' => $data->dtrealfinbancofarol,
                        'ffomeses' => $data->ffomeses,
                        'ffodelta' => $data->ffodelta,
                        'ffoprevrev' => $data->ffoprevrev,
                        'fforeal' => $data->fforeal,
                        'fdmeses' => $data->fdmeses,
                        'fddelta' => $data->fddelta,
                        'fdprevrev' => $data->fdprevrev,
                        'fdreal' => $data->fdreal,
                        'critpremultaconteco' => $data->critpremultaconteco,
                        'critpremultacontest' => $data->critpremultacontest,
                        'prevpremultaconstrs' => $data->prevpremultaconstrs,
                        'prevpremultaincorrs' => $data->prevpremultaincorrs,
                        'prevpremultaconstincc' => $data->prevpremultaconstincc,
                        'prevpremultaincorincc' => $data->prevpremultaincorincc,
                        'datasmarco' => $data->datasmarco,
                        'adiccritpremulta' => $data->adiccritpremulta
                    ];

                    Data::create($data);

                    $contador += 1;
                }

                $uploaddata->linecount = $contador;
            }

            $uploaddata->uploadstatus = 2;
            $uploaddata->update();

            return response()->json(["success" => 200]);
        }catch (Exception $e){
            $uploaddata->uploadstatus = 3;
            $uploaddata->update();
            return response()->json(["error" => 500]);
        }
    }
}
