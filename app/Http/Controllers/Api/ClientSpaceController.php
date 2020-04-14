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
use App\Models\Regional;
use App\Models\Business;
use App\Models\State;
use App\Models\UploadData;
use App\Models\UploadStatus;
use App\Models\UploadType;
use App\Models\User;
use App\Models\UsersToConstructions;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class  ClientSpaceController extends Controller
{
    private $construction, $responsible, $address, $location, $state, $city, $upload_data, $user, $accessprofile, $uploadstatus, $uploadtype, $data, $competence, $userstoconstructions;

    public function __construct(
        Construction $construction,
        Business $responsible,
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
            if ($user->access_profile != 1) {
                $where = " where uc.user = " . $user->id;
            }
            $competencesTop = DB::select("select co.id, co.description
                                                from competences as co
                                                    join upload_data as ud on ud.competence = co.id and ud.uploadtype = 1 and ud.uploadstatus = 2
                                                    join data as d on d.uploaddata = ud.id
                                                order by co.year desc, co.month desc
                                                limit 1");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();
            $competences = DB::select("select co.id, co.description
                                                from competences co
                                                    join upload_data ud on ud.competence = co.id and ud.uploadtype = 1 and ud.uploadstatus = 2
                                                    join data d on d.uploaddata = ud.id
                                                order by co.year desc, co.month desc");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();
            $constructions = DB::select("select distinct c.id, c.name from constructions c join users_to_constructions uc on uc.construction = c.id join data d on d.construction = c.id" . $where);

            $regionalWhere = '';
            if ($request->regionals){
                $regionalWhere = " where re.id in (".$request->regionals.")";
            }
            $regionals = DB::select("select distinct re.id, re.name
                                                from regionals re
                                                    join constructions c on c.regional = re.id
                                                    join data d on d.construction = c.id" . $regionalWhere);

            $regionalsSWhere = DB::select("select distinct re.id, re.name
                                                from regionals re
                                                    join constructions c on c.regional = re.id
                                                    join data d on d.construction = c.id");
            $regionals = Arr::pluck($regionals, 'name', 'id');
            $regionalsSWhere = Arr::pluck($regionalsSWhere, 'name', 'id');

            $businesses = DB::select("select distinct bs.id, bs.name
                                                from businesses bs
                                                    join constructions c on c.business = bs.id
                                                    join data d on d.construction = c.id");
            $businesses = Arr::pluck($businesses, 'name', 'id');

            $incc = '773,52';

            if (!$request->constructions || $request->constructions == 0) {
                if (count($constructions) > 0) {
                    $constructionsIdPluck = Arr::pluck($constructions, 'id');
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados referentes a(s) obra(s) solicitada(s).',
                        'return' => 'logout'
                    ]);
                }
            } else {
                $constructionsIdPluck = explode(',', $request->constructions);
            }

            if (!$request->competences || $request->competences == 0) {
                if (count($competencesTop) > 0) {
                    $competenceIdPluck = $competencesTop[0]->id;
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados de meses de referência cadastrados, entre em contato com o administrados.'
                    ]);
                }
            } else {
                $competenceIdPluck = [$request->competences];
            }

            $regionalsIdPluck = [];
            if (!$request->regionals || $request->regionals == 0) {
                if (count($regionals) > 0) {
                    foreach ($regionals as $regional => $regionaldesc) {
                        array_push($regionalsIdPluck, $regional);
                    }
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados de meses de referência cadastrados, entre em contato com o administrados.'
                    ]);
                }
            } else {
                $regionalsIdPluck = explode(',', $request->regionals);
            };
            $businessesIdPluck = [];
            if (!$request->businesses || $request->businesses == 0) {
                if (count($businesses) > 0) {
                    foreach ($businesses as $business => $businessdesc) {
                        array_push($businessesIdPluck, $business);
                    }
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados de meses de referência cadastrados, entre em contato com o administrados.'
                    ]);
                }
            } else {
                $businessesIdPluck = explode(',', $request->businesses);
            }

            $cores = [
                'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
                'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
                'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
            ];

            $dados = [];

            foreach (array_unique($regionals) as $regional => $regionalname) {
                $query = DB::table('constructions')
                    ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
                    ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
                    ->leftJoin('cities', 'cities.id', '=', 'locations.city')
                    ->leftJoin('states', 'states.id', '=', 'cities.state')
                    ->leftJoin('businesses', 'businesses.id', '=', 'constructions.business')
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
                        'businesses.name as business_name',
                        'constructions.responsible as responsible_name',
                        'constructions.cnpj as responsible_cnpj',
                        'constructions.work_number',
                        'addresses.street',
                        'addresses.number',
                        'locations.neighborhood',
                        'cities.name as city',
                        'states.name as state',
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
                    ->where('competences.id', '=', $competenceIdPluck);
                $query->whereIn('constructions.id', $constructionsIdPluck);
                $query->where('constructions.regional','=', $regional);
                $query->whereIn('constructions.business', $businessesIdPluck);

                $constructionInfos = $query->get();

                if (count($constructionInfos) > 0) {
                    $regionalobj = new Regional();

                    $regionalobj->id = $regional;
                    $regionalobj->name = $regionalname;
                    $regionalobj->AREACONSTRM2 = $constructionInfos->reduce(function ($carry, $item) {
                        return $carry + $item->AREACONSTRM2;
                    });
                    $regionalobj->NUNITQTD = $constructionInfos->reduce(function ($carry, $item) {
                        return $carry + $item->NUNITQTD;
                    });
                    $regionalobj->CORPRRATUAL = $constructionInfos->reduce(function ($carry, $item) {
                        return $carry + $item->CORPRRATUAL;
                    });
                    $regionalobj->CORRPRATUALFAROL = "amarelo";
                    $regionalobj->CORRPRATUALVLR = number_format(floatval(($constructionInfos->reduce(function ($carry, $item) {
                            return floatval($carry) + floatval($item->CORRPRATUALVLR);
                        })) / count($constructionInfos)), 2, ',', '.');
                    $regionalobj->constructions = $constructionInfos;
                    array_push($dados, $regionalobj);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        if (count($dados) > 0) {
            return view('area-do-cliente.index', [
                'incc' => $incc,
                'regionals' => $regionalsSWhere,
                'constructions' => $constructions,
                'competences' => Arr::pluck($competences, 'description', 'id'),
                'businesses' => $businesses,
                'cores' => $cores,
                'dados' => $dados,
                'competencesselected' => is_array($competenceIdPluck) ? $competenceIdPluck : [$competenceIdPluck],
                'regionalsselected' => is_array($regionalsIdPluck) ? $regionalsIdPluck : [$regionalsIdPluck],
                'businessesselected' => is_array($businessesIdPluck) ? $businessesIdPluck : [$businessesIdPluck],
                'constructionsselected' => $constructionsIdPluck
            ]);
        } else {
            return view('area-do-cliente.erro', [
                'error' => 'Não é possível acessar esta página pois não foram encontrados dados referentes a(s) obra(s) solicitada(s).'
            ]);
        }
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
        if ($user->access_profile != 1) {
            $where = " where uc.user = " . $user->id;
        }

        $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id join data d on d.construction = c.id " . $where);

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
                'uploadtype' => 3,
                'uploadstatus' => 2
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
                'uploadtype' => 4,
                'uploadstatus' => 2
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
            ->leftJoin('businesses', 'businesses.id', '=', 'constructions.business')
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
                'constructions.responsible as responsible_name',
                'constructions.cnpj as responsible_cnpj',
                'constructions.work_number',
                'businesses.name as business_name',
                'addresses.street',
                'addresses.number',
                'locations.neighborhood',
                'cities.name as city',
                'states.name as state',
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

        $competences = DB::select("select co.id, co.description
                                                from competences co
                                                    join upload_data ud on ud.competence = co.id and ud.uploadtype = 1 and ud.uploadstatus = 2
                                                    join data d on d.uploaddata = ud.id
                                                where d.construction = " . $id . "
                                                order by co.year desc, co.month desc");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();
        return view('area-do-cliente.detalhe', [
            'details' => $details[0],
            'competences' => $competences,
            'cores' => $cores,
            'competencesselected' => is_array($competence[0]->id) ? $competence[0]->id : [$competence[0]->id],
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
                'uploadtype' => 2,
                'uploadstatus' => 2
            ]
        )->get();


        $competences = DB::select("select co.id, co.description, co.month, co.year
                                                from competences co
                                                    join upload_data ud on ud.competence = co.id and ud.uploadtype = 2 and uploadstatus = 2
                                                where ud.construction = " . $id . "
                                                order by co.year desc, co.month desc");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();

        $competencesYear = Arr::pluck($competences, 'year');
        $competencesMonth = Arr::pluck($competences, 'month');

        if (auth()->user()) {
            $user = $this->user->find(auth()->user()->id);
        } else {
            redirect()->route('client-space.logout');
        }


        $where = '';
        if ($user->access_profile != 1) {
            $where = " where uc.user = " . $user->id;
        }

        $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id join data d on d.construction = c.id " . $where);

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
                'uploadtype' => 3,
                'uploadstatus' => 2
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
                'uploadtype' => 4,
                'uploadstatus' => 2
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
                'uploadtype' => 2,
                'uploadstatus' => 2])
                ->get();
            $competence->documents = $documents;
            if (count($documents) > 0) {
                array_push($dados, $competence);
            }
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
                'uploadtype' => 2,
                'uploadstatus' => 2
            ])
                ->get();
            $competence->documents = $documents;
            if (count($documents) > 0) {
                array_push($dados, $competence);
            }
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
            if ($user->access_profile != 1) {
                $where = " where uc.user = " . $user->id;
            }

            $competences = DB::select("select co.id, co.description
                                                from competences co
                                                    join upload_data ud on ud.competence = co.id and ud.uploadtype = 1 and ud.uploadstatus = 2
                                                    join data d on d.uploaddata = ud.id
                                                order by co.year desc, co.month desc");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();

            $constructions = DB::select("select distinct c.id, c.name from constructions c join users_to_constructions uc on uc.construction = c.id join data d on d.construction = c.id" . $where);

            $regionals = DB::select("select distinct re.id, re.name
                                                from regionals re
                                                    join constructions c on c.regional = re.id
                                                    join data d on d.construction = c.id");
            $regionals = Arr::pluck($regionals, 'name', 'id');

            $businesses = DB::select("select distinct bs.id, bs.name
                                                from businesses bs
                                                    join constructions c on c.business = bs.id
                                                    join data d on d.construction = c.id");
            $businesses = Arr::pluck($businesses, 'name', 'id');

            $incc = '773,52';

            if (!$request->constructions || $request->constructions == 0) {
                if (count($constructions) > 0) {
                    $constructionsIdPluck = Arr::pluck($constructions, 'id');
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados referentes a(s) obra(s) solicitada(s).',
                        'return' => 'logout'
                    ]);
                }
            } else {
                $constructionsIdPluck = explode(',', $request->constructions);
            }

            $regionalsIdPluck = [];
            if (!$request->regionals || $request->regionals == 0) {
                if (count($regionals) > 0) {
                    foreach ($regionals as $regional => $regionaldesc) {
                        array_push($regionalsIdPluck, $regional);
                    }
                } else {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados de meses de referência cadastrados, entre em contato com o administrados.'
                    ]);
                }
            } else {
                $regionalsIdPluck = explode(',', $request->regionals);
            };

            if ($request->competences || $request->competences != 0) {
                $competenceIdPluck = [$request->competences];
            } else if (!$request->competences) {
                $compatual = DB::select("select co.id, co.description
                                                from competences co
                                                    join upload_data ud on ud.competence = co.id and ud.uploadtype = 1 and ud.uploadstatus = 2
                                                    join data d on d.uploaddata = ud.id
                                                order by co.year desc, co.month desc
                                                limit 1");//$this->competence->where('status', '=', 1)->orderBy('year')->orderBy('month')->get();
                if (count($compatual) <= 0) {
                    return view('area-do-cliente.erro', [
                        'error' => 'Não é possível acessar esta página pois não foram encontrados dados meses de referencia cadastrados, solicite ao administrador que os cadastre.',
                        'return' => 'inicio'
                    ]);
                }
                $competenceIdPluck = $compatual[0]->id;
            }

            $dados = [];

            foreach (array_unique($regionalsIdPluck) as $regional => $regionalname) {
                $query = DB::table('constructions')
                    ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
                    ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
                    ->leftJoin('cities', 'cities.id', '=', 'locations.city')
                    ->leftJoin('states', 'states.id', '=', 'cities.state')
                    ->leftJoin('businesses', 'businesses.id', '=', 'constructions.business')
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
                        'constructions.responsible as responsible_name',
                        'constructions.cnpj as responsible_cnpj',
                        'constructions.work_number',
                        'businesses.name as business_name',
                        'addresses.street',
                        'addresses.number',
                        'locations.neighborhood',
                        'cities.name as city',
                        'states.name as state',
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
                    ->where('competences.id', '=', $competenceIdPluck);
                $query->whereIn('constructions.id', $constructionsIdPluck);
                $query->where('constructions.regional','=', $regional);
                $query->whereIn('constructions.business', $businessesIdPluck);
                $reports = $query->get();

                if (count($reports) > 0) {
                    $regionalobj = new Regional();

                    $regionalobj->id = $regional;
                    $regionalobj->name = $regionalname;

                    $regionalobj->reports = $reports;

                    array_push($dados, $regionalobj);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        if (count($dados) > 0) {
            return view('area-do-cliente.relatorio', [
                'competences' => Arr::pluck($competences, 'description', 'id'),
                'constructions' => $constructions,
                'regionals' => $regionals,
                'businesses' => $businesses,
                'dados' => $dados,
                'constructionsselected' => $constructionsIdPluck,
                'competencesselected' => is_array($competenceIdPluck) ? $competenceIdPluck : [$competenceIdPluck],
                'regionalsselected' => is_array($regionalsIdPluck) ? $regionalsIdPluck : [$regionalsIdPluck],
                'businessesselected' => is_array($businessesIdPluck) ? $businessesIdPluck : [$businessesIdPluck],
                'incc' => $incc
            ]);
        } else {
            return view('area-do-cliente.erro', [
                'error' => 'Não é possível acessar esta página pois não foram encontrados dados referentes a(s) obra(s) solicitada(s).'
            ]);
        }
    }

    public function downloadPictures($uploadDataId)
    {
        $data = $this->upload_data->find($uploadDataId);

        if ($data && !empty($data)) {
            return response()->redirectTo(url('storage/' . $data->file));
        } else {
            return response()->json(['erro' => 'Não existe arquivo de fotos nessa obra para o mês de referência selecionado']);
        }
    }

    public function downloadReports($uploadDataId)
    {
        $data = $this->upload_data->find($uploadDataId);

        if ($data) {
            return response()->redirectTo(url('storage/' . $data->file));
        } else {
            return response()->json(['erro' => 'Não existe arquivo de fotos nessa obra para o mês de referência selecionado']);
        }
    }


    public function getResetForm(Request $request, $token = null)
    {
        return view('area-do-cliente.nova_senha')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

}
