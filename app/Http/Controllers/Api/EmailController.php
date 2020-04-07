<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendConstructionMail;
use App\Models\Competence;
use App\Models\Data;
use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index($competenceId){
        if ($competenceId != 0) {
            try {
                if (auth()->user()) {
                    $user = User::find(auth()->user()->id);
                } else {
                    redirect()->route('client-space.logout');
                }

                $where = '';
                if ($user->access_profile == 2) {
                    $where = " where uc.user = " . $user->id;
                }

                $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id" . $where);

                $competences = Competence::get();

                $constructionsIdPluck = Arr::pluck($constructions, 'id');

                $cores = [
                    'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
                    'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
                    'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
                ];

                $constructions = DB::table('constructions')
                    ->leftJoin('addresses', 'addresses.id', '=', 'constructions.address')
                    ->leftJoin('locations', 'locations.id', '=', 'addresses.location')
                    ->leftJoin('cities', 'cities.id', '=', 'locations.city')
                    ->leftJoin('states', 'states.id', '=', 'cities.state')
                    ->leftJoin('responsibles', 'responsibles.id', '=', 'constructions.business')
                    ->leftJoin('data', 'data.construction', '=', 'constructions.id')
                    ->leftJoin('upload_data', 'upload_data.id', '=', 'data.uploaddata')
                    ->leftJoin('competences', 'competences.id', '=', 'upload_data.competence')
                    ->leftJoin('upload_types', 'upload_types.id', '=', 'upload_data.uploadtype')
                    ->leftJoin('upload_statuses', 'upload_statuses.id', '=', 'upload_data.uploadstatus')
                    ->select(
                        'constructions.id as construction_id',
                        'constructions.name as construction_name',
                        'constructions.work_number',
                        'data.id as data_id',
                        'data.FASE',
                        'data.AREACONSTRM2',
                        'data.NUNITQTD',
                        'data.CUSTOP',
                        'data.PRAZO',
                        'data.FLUXOD',
                        'data.QUALIDADE',
                        'data.SEGORG',
                        'data.MAMBI',
                        'data.ACUMCONTR',
                        'data.email_sended_at'
                    )
                    ->whereIn('constructions.id', $constructionsIdPluck)
                    ->where('competences.id', '=', $competenceId)
                    ->get();
            } catch (Exception $e) {
                dd($e);
            }
            return view('administrativo.mail.index', [
                'constructions' => $constructions,
                'competences' => $competences,
                'cores' => $cores,
                'competenceSelected' => $competenceId
            ]);
        }else{
            return view('administrativo.mail.error', [
                'error' => 'Você ainda não pode acessar essa página pois não existem meses de referência cadastrados.'
            ]);
        }
    }
    public function indexWithoutArgs(){
        $competence = Competence::take(1)->orderBy('id','desc')->get();

        if($competence && count($competence) > 0)
            return $this->index($competence[0]->id);

        return $this->index(0);
    }

    public function store($data){
        try {
            foreach (explode(',',$data) as $dt) {
                $users = DB::select("
                    select
                        email
                    from
                        users u
                            join users_to_constructions uc on uc.user = u.id
                            join constructions c on c.id = uc.construction
                            join data d on d.construction = c.id
                    where
                        d.id = " . $dt);
                $emails = Arr::pluck($users,'email');
                Mail::to($emails)->send(new SendConstructionMail($dt));
                $dataUp = Data::find($dt);
                $dataUp->email_sended_at = date("Y-m-d");
                $dataUp->update();
                sleep(1);
            }
            return response()->json(['success' => $emails], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao enviar o e-mail\\n'.$e->getMessage()], 500);
        }
    }
}
