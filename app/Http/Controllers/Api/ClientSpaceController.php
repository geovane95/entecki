<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResponsibleRequest;
use App\Models\AccessProfile;
use App\Models\Address;
use App\Models\City;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\Location;
use App\Models\Regional;
use App\Models\Responsible;
use App\Models\State;
use App\Models\UploadData;
use App\Models\UploadStatus;
use App\Models\UploadType;
use App\Models\User;
use App\Models\UsersToConstructions;
use http\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Cast\Object_;

class  ClientSpaceController extends Controller
{
    private $construction, $responsible, $address, $location, $state, $city, $upload_data, $user, $accessprofile, $uploadstatus, $uploadtype, $data, $competence, $userstoconstructions;

    public function __construct(
        Construction $construction,
        Responsible $responsible,
        Regional $regional,
        Address $address,
        Location $location,
        State $state,
        City $city,
        UploadData $upload_data,
        User $user,
        AccessProfile $accessprofile,
        UploadStatus $uploadstatus,
        UploadType $uploadtype,
        Data $data,
        Competence $competence,
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
        $this->user = $user;
        $this->accessprofile = $accessprofile;
        $this->uploadstatus = $uploadstatus;
        $this->uploadtype = $uploadtype;
        $this->data = $data;
        $this->competence = $competence;
        $this->userstoconstructions = $usersToConstructions;
    }

    public function index(Request $request)
    {
        try {
            if (auth()->user()) {
                $user = $this->user->find(auth()->user()->id);
            } else {
                redirect()->route('client-space.logout');
            }

            $where = '';
            if ($user->access_profile == 2) {
                $where = " where uc.user = " . $user->id;
            }
            $competences = $this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();

            $constructions = DB::select("select distinct c.id, c.name from constructions c join users_to_constructions uc on uc.construction = c.id" . $where);

            $regionals = $this->regional->where('status', '=', 1)->orderBy('name')->get();

            $incc = '773,52';

            if (!$request->constructions || $request->constructions == 0) {
                $constructionsIdPluck = Arr::pluck($constructions, 'id');
            } else {
                $constructionsIdPluck = explode(',', $request->constructions);
            }

            if (!$request->competences || $request->competences == 0) {
                $competenceIdPluck = Arr::pluck($competences, 'id');
            } else {
                $competenceIdPluck = [$request->competences];
            }

            if (!$request->regionals || $request->regionals == 0) {
                $regionalIdPluck = Arr::pluck($regionals, 'id');
            } else {
                $regionalIdPluck = explode(',', $request->regionals);
            }

            $cores = [
                'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
                'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
                'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
            ];

            $dados = [];

            foreach ($regionals as $regional) {
                $query = DB::table('constructions')
                    ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
                    ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
                    ->leftJoin('cities', 'cities.id', '=', 'locations.city')
                    ->leftJoin('states', 'states.id', '=', 'cities.state')
                    ->leftJoin('responsibles', 'responsibles.id', '=', 'constructions.responsible')
                    ->join('data', 'data.construction', '=', 'constructions.id')
                    ->join('upload_data', 'upload_data.id', '=', 'data.uploaddata')
                    ->leftJoin('competences', 'competences.id', '=', 'upload_data.competence')
                    ->leftJoin('upload_types', 'upload_types.id', '=', 'upload_data.uploadtype')
                    ->leftJoin('upload_statuses', 'upload_statuses.id', '=', 'upload_data.uploadstatus')
                    ->select(
                        'constructions.id as construction_id',
                        'constructions.name as construction_name',
                        'constructions.status as construction_status',
                        'constructions.thumbnail',
                        'constructions.company',
                        'constructions.contract_regime',
                        'constructions.reporting_regime as report_regime',
                        'constructions.issuance_date',
                        'constructions.work_number',
                        'addresses.street',
                        'addresses.number',
                        'locations.neighborhood',
                        'cities.name as city',
                        'states.name as state',
                        'responsibles.company_name as responsible_name',
                        'responsibles.cnpj as responsible_cnpj',
                        'data.FASE',
                        'data.AREACONSTRM2',
                        'data.NUNITQTD',
                        'data.CORPRRATUAL',
                        'data.CORRPRATUALFAROL',
                        'data.CORRPRATUALVLR',
                        'data.FXDPRRATUAL',
                        'data.FXDRPRATUALFAROL',
                        'data.FXDRPRATUALVLR',
                        'data.FPRPRFAROL',
                        'data.FPRPR',
                        'data.POTEROBRARPMESFAROL',
                        'data.POTEROBRARPMES',
                        'data.POECOPR',
                        'data.IDQFAROL',
                        'data.IDSFAROL',
                        'data.PORCCONTRATINDIC',
                        'data.ACORCPROOJATUAL',
                        'data.APORCPROOJATUAL',
                        'competences.id as competence_id',
                        'competences.month',
                        'competences.year',
                        'competences.description',
                        'upload_types.name as upload_type_name',
                        'upload_statuses.name as upload_status_name'
                    )
                    ->where('competences.id', '=', $competenceIdPluck)
                    ->where('constructions.regional', '=', $regional->id);
                $query->whereIn('constructions.id', $constructionsIdPluck);

                $constructionInfos = $query->get();

                $regional->constructions = $constructionInfos;

                array_push($dados, $regional);
            }
        } catch (Exception $e) {
            dd($e);
        }
        return view('area-do-cliente.index', [
            'incc' => $incc,
            'regionals' => $regionals,
            'constructions' => $constructions,
            'competences' => $competences,
            'cores' => $cores,
            'dados' => $dados,
            'competencesselected' => $competenceIdPluck,
            'regionalsselected' => $regionalIdPluck,
            'constructionsselected' => $constructionsIdPluck
        ]);
    }

    public function detail($id, $competence)
    {

        $cores = [
            'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
            'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
            'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
        ];

        if (auth()->user()) {
            $user = $this->user->find(auth()->user()->id);
        } else {
            redirect()->route('client-space.logout');
        }

        $where = '';
        if ($user->access_profile == 2) {
            $where = " where uc.user = " . $user->id;
        }

        $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id " . $where);

        $nextContruction = 0;
        $previousConstruction = 0;
        $findOk = false;
        foreach ($constructions as $construction) {
            if (!$findOk) {
                if ($construction->id != $id) {
                    $previousConstruction = $construction->id;
                } else {
                    $findOk = true;
                }
            } else {
                $nextContruction = $construction->id;
                break;
            }
        }

        $picture = $this->upload_data
            ->where([
                'construction' => $id,
                'competence' => $competence,
                'uploadtype' => 3
            ])
            ->get();
        if (count($picture) <= 0) {
            $picture = false;
        } else {
            $picture = $picture[0];
        }

        $report = $this->upload_data
            ->where([
                'construction' => $id,
                'competence' => $competence,
                'uploadtype' => 4
            ])
            ->get();
        if (count($report) <= 0) {
            $report = false;
        } else {
            $report = $report[0];
        }

        $competence = $this->competence->where('id', '=', $competence)->orderBy('year')->orderBy('month')->get();

        $details = DB::table('constructions')
            ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
            ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
            ->leftJoin('cities', 'cities.id', '=', 'locations.city')
            ->leftJoin('states', 'states.id', '=', 'cities.state')
            ->leftJoin('responsibles', 'responsibles.id', '=', 'constructions.responsible')
            ->leftJoin('data', 'data.construction', '=', 'constructions.id')
            ->leftJoin('upload_data', 'upload_data.id', '=', 'data.uploaddata')
            ->leftJoin('competences', 'competences.id', '=', 'upload_data.competence')
            ->leftJoin('upload_types', 'upload_types.id', '=', 'upload_data.uploadtype')
            ->leftJoin('upload_statuses', 'upload_statuses.id', '=', 'upload_data.uploadstatus')
            ->select(
                'constructions.id as construction_id',
                'constructions.name as construction_name',
                'constructions.status as construction_status',
                'constructions.thumbnail',
                'constructions.company',
                'constructions.contract_regime',
                'constructions.reporting_regime as report_regime',
                'constructions.issuance_date',
                'constructions.work_number',
                'addresses.street',
                'addresses.number',
                'locations.neighborhood',
                'cities.name as city',
                'states.name as state',
                'responsibles.company_name as responsible_name',
                'responsibles.cnpj as responsible_cnpj',
                'competences.id as competence_id',
                'competences.month',
                'competences.year',
                'competences.description',
                'upload_types.name as upload_type_name',
                'upload_statuses.name as upload_status_name',
                'data.*'
            )
            ->where(['constructions.id' => $id, 'competences.id' => $competence[0]->id])
            ->get();
        $competences = $this->competence->get()->where('status', '=', 1);
        return view('area-do-cliente.detalhe', [
            'details' => $details[0],
            'competences' => $competences,
            'cores' => $cores,
            'competencesselected' => $competence[0]->id,
            'nextConstruction' => $nextContruction,
            'previousConstruction' => $previousConstruction,
            'picture' => $picture,
            'report' => $report
        ]);
    }

    public function documents($competenceId, $id)
    {
        $construction = $this->construction->find($id);
        $competence = $this->competence->find($competenceId);
        $documents = $this->upload_data->where([
                'construction' => $construction->id,
                'competence' => $competence->id,
                'uploadtype' => 2]
        )->get();

        $competences = $this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();
        $competencesYear = Arr::pluck($competences, 'year');
        $competencesMonth = Arr::pluck($competences, 'month');

        if (auth()->user()) {
            $user = $this->user->find(auth()->user()->id);
        } else {
            redirect()->route('client-space.logout');
        }

        $where = '';
        if ($user->access_profile == 2) {
            $where = " where uc.user = " . $user->id;
        }

        $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id " . $where);

        $nextContruction = 0;
        $previousConstruction = 0;
        $findOk = false;
        foreach ($constructions as $construction) {
            if (!$findOk) {
                if ($construction->id != $id) {
                    $previousConstruction = $construction->id;
                } else {
                    $findOk = true;
                }
            } else {
                $nextContruction = $construction->id;
                break;
            }
        }

        $picture = $this->upload_data
            ->where([
                'construction' => $id,
                'competence' => $competenceId,
                'uploadtype' => 3
            ])
            ->get();
        if (count($picture) <= 0) {
            $picture = false;
        } else {
            $picture = $picture[0];
        }

        $report = $this->upload_data
            ->where([
                'construction' => $id,
                'competence' => $competenceId,
                'uploadtype' => 4
            ])
            ->get();
        if (count($report) <= 0) {
            $report = false;
        } else {
            $report = $report[0];
        }

        $meses = [
            1 => 'JANEIRO',
            2 => 'FEVEREIRO',
            3 => 'MARÇO',
            4 => 'ABRIL',
            5 => 'MAIO',
            6 => 'JUNHO',
            7 => 'JULHO',
            8 => 'AGOSTO',
            9 => 'SETEMBRO',
            10 => 'OUTUBRO',
            11 => 'NOVEMBRO',
            12 => 'DEZEMBRO'
        ];

        return view('area-do-cliente.docs_obra', [
            'documents' => $documents,
            'competence' => $competence,
            'competencesYear' => $competencesYear,
            'competencesMonth' => $competencesMonth,
            'construction' => $construction,
            'actualcomp' => $competenceId,
            'actualconst' => $id,
            'meses' => $meses,
            'nextConstruction' => $nextContruction,
            'previousConstruction' => $previousConstruction,
            'picture' => $picture,
            'report' => $report
        ]);
    }

    public function documentsByMonthYear($constructionId, $month, $year)
    {

        $construction = $this->construction->find($constructionId);

        $competences = $this->competence->where([
            'month' => intval($month),
            'year' => intval($year)
        ])->orderBy('year')->orderBy('month')->get();

        if (!$competences)
            return response()->json(['erro' => 500, 'message' => 'Não foram localizados meses de referencia para as escolhas']);

        $dados = [];

        foreach ($competences as $competence) {
            $documents = $this->upload_data->where([
                'construction' => $construction->id,
                'competence' => $competence->id,
                'uploadtype' => 2])
                ->get();
            $competence->documents = $documents;
            array_push($dados, $competence);
        }
        return response()->json(['success' => $dados]);
    }

    public function documentsByYearOrMonth($constructionId, $yearmonth)
    {

        $construction = $this->construction->find($constructionId);

        if ($yearmonth > 0 && $yearmonth <= 12) {
            $competences = $this->competence->where([
                'month' => intval($yearmonth)
            ])->get();
        } elseif ($yearmonth > 1900) {
            $competences = $this->competence->where([
                'year' => intval($yearmonth)
            ])->get();
        } else {
            return response()->json(['erro' => 500, 'message' => 'Não foram localizados meses de referencia para as escolhas']);
        }

        if (!$competences)
            return response()->json(['erro' => 500, 'message' => 'Não foram localizados meses de referencia para as escolhas']);

        $dados = [];

        foreach ($competences as $competence) {
            $documents = $this->upload_data->where([
                'construction' => $construction->id,
                'competence' => $competence->id,
                'uploadtype' => 2])
                ->get();
            $competence->documents = $documents;
            array_push($dados, $competence);
        }
        return response()->json(['success' => $dados]);
    }

    public function report(Request $request)
    {


        try {
            if (auth()->user()) {
                $user = $this->user->find(auth()->user()->id);
            } else {
                redirect()->route('client-space.logout');
            }

            $where = '';
            if ($user->access_profile == 2) {
                $where = " where uc.user = " . $user->id;
            }

            $competences = $this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();

            $constructions = DB::select("select distinct c.id, c.name from constructions c join users_to_constructions uc on uc.construction = c.id" . $where);

            $regionals = $this->regional->where('status', '=', 1)->orderBy('name')->get();

            $incc = '773,52';

            if (!$request->constructions) {
                $constructionsIdPluck = Arr::pluck($constructions, 'id');
            } else {
                $constructionsIdPluck = explode(',', $request->constructions);
            }

            if (!$request->regionals) {
                $regionalsIdPluck = Arr::pluck($regionals, 'id');
            } else {
                $regionalsIdPluck = explode(',', $request->regionals);
            }

            if (!$request->competences) {
                $compatual = $this->competence->orderBy('id', 'desc')->take(1)->get()->where('status', '=', 1);
                $competenceIdPluck = Arr::pluck($compatual, 'id');
            } else {
                $competenceIdPluck = [$request->competences];
            }

            $dados = [];

            foreach ($regionals as $regional) {
                $reports = DB::table('constructions')
                    ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
                    ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
                    ->leftJoin('cities', 'cities.id', '=', 'locations.city')
                    ->leftJoin('states', 'states.id', '=', 'cities.state')
                    ->leftJoin('responsibles', 'responsibles.id', '=', 'constructions.responsible')
                    ->join('data', 'data.construction', '=', 'constructions.id')
                    ->join('upload_data', 'upload_data.id', '=', 'data.uploaddata')
                    ->join('competences', 'competences.id', '=', 'upload_data.competence')
                    ->join('upload_types', 'upload_types.id', '=', 'upload_data.uploadtype')
                    ->join('upload_statuses', 'upload_statuses.id', '=', 'upload_data.uploadstatus')
                    ->select(
                        'constructions.id as construction_id',
                        'constructions.name as construction_name',
                        'constructions.status as construction_status',
                        'constructions.thumbnail',
                        'constructions.company',
                        'constructions.contract_regime',
                        'constructions.reporting_regime as report_regime',
                        'constructions.issuance_date',
                        'constructions.work_number',
                        'addresses.street',
                        'addresses.number',
                        'locations.neighborhood',
                        'cities.name as city',
                        'states.name as state',
                        'responsibles.company_name as responsible_name',
                        'responsibles.cnpj as responsible_cnpj',
                        'data.FASE',
                        'data.AREACONSTRM2',
                        'data.NUNITQTD',
                        'data.FBP',
                        'data.FBR',
                        'data.FBD',
                        'data.FOP',
                        'data.FOR',
                        'data.FOD',
                        'data.FOBP',
                        'data.FOBR',
                        'data.FOBD',
                        'competences.id as competence_id',
                        'competences.month',
                        'competences.year',
                        'competences.description',
                        'upload_types.name as upload_type_name',
                        'upload_statuses.name as upload_status_name'
                    )
                    ->whereIn('constructions.id', $constructionsIdPluck)
                    ->whereIn('competences.id', $competenceIdPluck)
                    ->where('constructions.regional', '=', $regional->id)
                    ->get();

                $regional->reports = $reports;

                if (count($reports) > 0)
                    array_push($dados, $regional);
            }
        } catch (Exception $e) {
            dd($e);
        }

        return view('area-do-cliente.relatorio', [
            'competences' => $competences,
            'constructions' => $constructions,
            'regionals' => $regionals,
            'dados' => $dados,
            'competencesselected' => $competenceIdPluck,
            'constructionsselected' => $constructionsIdPluck,
            'regionalsselected' => $regionalsIdPluck,
            'incc' => $incc
        ]);
    }

    public function downloadPictures($uploadDataId)
    {
        $data = $this->upload_data->find($uploadDataId);

        if ($data && !empty($data)) {
            return response()->download(url($data[0]->file));
        } else {
            return response()->json(['erro' => 'Não existe arquivo de fotos nessa obra para o mês de referência selecionado']);
        }
    }

    public function downloadReports($uploadDataId)
    {
        $data = $this->upload_data->find($uploadDataId);

        if ($data) {
            return response()->download(url('storage/' . $data->file));
        } else {
            return response()->json(['erro' => 'Não existe arquivo de fotos nessa obra para o mês de referência selecionado']);
        }
    }

    public function fisLocalAcumMacroEtapas($id)
    {
        $where = '';

        $competences = DB::select("select * from competences ".$where." order by id desc");
        $dados = [];
        $contreg = (count($competences) / 2);
        foreach ($competences as $competence) {
            $fisAcumMacroEtapas = new Data();
            if ($id == $competence->id){
                $fisAcumMacroEtapas->periodofisprev = 0;
                $fisAcumMacroEtapas->periodofisprevmesaatual = rand(0, 100);
            }else {
                $fisAcumMacroEtapas->periodofisprev = rand(0, 100);
                $fisAcumMacroEtapas->periodofisprevmesaatual = 0;
            }
            $fisAcumMacroEtapas->acumulofisreal = rand(0,150) * (rand(0,100) / 100);
            if ($contreg < 1) {
                $fisAcumMacroEtapas->acumulofisprev = 0;
                $fisAcumMacroEtapas->acumulofisproj = rand(0,150) * (rand(0,100) / 100);
            }else {
                $fisAcumMacroEtapas->acumulofisprev = rand(0,150) * (rand(0,100) / 100);
                $fisAcumMacroEtapas->acumulofisproj = 0;
            }
            if ($contreg < 1) {
                $fisAcumMacroEtapas->periodofissubprev = 0;
                $fisAcumMacroEtapas->periodofisproj = rand(0, 100);
            }else {
                $fisAcumMacroEtapas->periodofissubprev = rand(0, 100);
                $fisAcumMacroEtapas->periodofisproj = 0;
            }

            $competence->fisacummacroetapas = $fisAcumMacroEtapas;

            array_push($dados, $competence);
            $contreg -= 1;
        }
        return response()->json([
            $dados
        ]);
    }

    public function desempFinan($id)
    {
        $where = '';

        $competences = DB::select("select * from competences ".$where." order by id desc");
        $dados = [];
        $contreg = (count($competences) / 2);
        foreach ($competences as $competence) {
            $desempFinan = new Data();
            if ($id == $competence->id){
                $desempFinan->periodofisprev = 0;
                $desempFinan->periodofisprevmesaatual = rand(0, 100);
            }else {
                $desempFinan->periodofisprev = rand(0, 100);
                $desempFinan->periodofisprevmesaatual = 0;
            }
            $desempFinan->acumulofisreal = rand(0,150) * (rand(0,100) / 100);
            if ($contreg < 1) {
                $desempFinan->acumulofisprev = 0;
                $desempFinan->acumulofisproj = rand(0,150) * (rand(0,100) / 100);
            }else {
                $desempFinan->acumulofisprev = rand(0,150) * (rand(0,100) / 100);
                $desempFinan->acumulofisproj = 0;
            }
            if ($contreg < 1) {
                $desempFinan->periodofissubprev = 0;
                $desempFinan->periodofisproj = rand(0, 100);
            }else {
                $desempFinan->periodofissubprev = rand(0, 100);
                $desempFinan->periodofisproj = 0;
            }

            $competence->desempfinan = $desempFinan;

            array_push($dados, $competence);
            $contreg -= 1;
        }
        return response()->json([
            $dados
        ]);
    }

    public function analiseFisicaFinanceira($id)
    {

    }

    public function fluxoFinanObra($id)
    {
        $where = '';

        $competences = DB::select("select * from competences ".$where." order by id desc limit 4");
        $dados = [];

        foreach ($competences as $competence) {
            $fluxoFinanObra = new Data();
            $fluxoFinanObra->delta = 2.55;
            $fluxoFinanObra->prevrev = 1134271;
            $fluxoFinanObra->real = 684851;

            $competence->fluxofinanobra = $fluxoFinanObra;

            array_push($dados, $competence);
        }
        return response()->json([
            $dados
        ]);
    }

    public function fluxoDesemb($id)
    {
        $where = '';

        $competences = DB::select("select * from competences ".$where." order by id desc limit 2");
        $dados = [];

        foreach ($competences as $competence) {
            $fluxoDesemb = new Data();
            $fluxoDesemb->delta = 2.55;
            $fluxoDesemb->prevrev = 1134271;
            $fluxoDesemb->real = 684851;

            $competence->fluxodesemb = $fluxoDesemb;

            array_push($dados, $competence);
        }
        return response()->json([
            $dados
        ]);
    }
}
