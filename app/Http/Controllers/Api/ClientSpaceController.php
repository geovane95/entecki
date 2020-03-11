<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessProfile;
use App\Models\Address;
use App\Models\City;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\Location;
use App\Models\Responsible;
use App\Models\State;
use App\Models\UploadData;
use App\Models\UploadStatus;
use App\Models\UploadType;
use App\Models\User;
use App\Models\UsersToConstructions;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class  ClientSpaceController extends Controller
{
    private $construction, $responsible, $address, $location, $state, $city, $upload_data, $user, $accessprofile, $uploadstatus, $uploadtype, $data, $competence, $userstoconstructions;

    public function __construct(
        Construction $construction,
        Responsible $responsible,
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

    public function index($competenceId = 0,$constructionId = 0)
    {
        try {
            if (auth()->user()) {
                $user = $this->user->find(auth()->user()->id);
            } else {
                redirect()->route('client-space.logout');
            }

            $where = '';
            if ($user->access_profile == 2){
                $where = " where uc.user = " . $user->id;
            }

            $competences = $this->competence->get()->where('status', '=', 1);

            $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id".$where);
            $incc = '773,52';

            if ($constructionId == 0) {
                $constructionsIdPluck = Arr::pluck($constructions, 'id');
            }else{
                $constructionsIdPluck = [$constructionId];
            }

            if ($competenceId == 0){
                $competenceIdPluck = Arr::pluck($competences,'id');
            }else{
                $competenceIdPluck = [$competenceId];
            }

            $cores = [
                'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
                'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
                'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
            ];

            $constructionstable = DB::table('constructions')
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
                ->whereIn('constructions.id', $constructionsIdPluck)
                ->whereIn('competences.id',$competenceIdPluck)
                ->get();
        } catch (Exception $e) {
            dd($e);
        }
        return view('area-do-cliente.index', [
            'incc' => $incc,
            'constructions' => $constructions,
            'competences' => $competences,
            'cores' => $cores,
            'constructionstable' => $constructionstable,
            'competencesselected' => $competenceIdPluck,
            'construtionsselected' => $constructionsIdPluck
        ]);
    }

    public function detail($id)
    {
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
            ->where('constructions.id', '=', $id)
            ->get();
            $competences = $this->competence->get()->where('status', '=', 1);
        return view('area-do-cliente.detalhe', [
            'details' => $details[0],
            'competences'=>$competences

        ]);
    }

    public function documents($competenceId,$id){
        $construction = $this->construction->find($id);
        $competence = $this->competence->find($competenceId);
        $documents = $this->upload_data->get()->where(
            ['construction','=',$construction->id],
            ['competence','=',$competence->id],
            ['uploadtype','=',2]
        );

        return view('area-do-cliente.docs_obra', ['documents'=>$documents, 'competence'=>$competence, 'construction'=>$construction, 'actualcomp' => $competenceId, 'actualconst' => $id]);
    }

    public function report($id){
        $relatorio = DB::table('constructions')
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
                'competences.month',
                'competences.year',
                'competences.description',
                'upload_types.name as upload_type_name',
                'upload_statuses.name as upload_status_name'
            )
            ->where('constructions.id', '=', $id)
            ->get();
        return view('area-do-cliente.relatorio', $relatorio);
    }
}
