<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function index(){
        try {
            if (auth()->user()) {
                $user = User::find(auth()->user()->id);
            } else {
                redirect()->route('client-space.logout');
            }

            $where = '';
            if ($user->access_profile == 2){
                $where = " where uc.user = " . $user->id;
            }

            $competences = Competence::get()->where('status', '=', 1);

            $constructions = DB::select("select * from constructions c join users_to_constructions uc on uc.construction = c.id".$where);
            $incc = '773,52';

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
                ->leftJoin('responsibles', 'responsibles.id', '=', 'constructions.responsible')
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
                ->whereIn('constructions.id', [1, 2, 3, 4, 5, 6])
                ->get();
        } catch (Exception $e) {
            dd($e);
        }
        return view('administrativo.mail.index', ['constructions' => $constructions, 'competences' => $competences, 'cores' => $cores]);
    }
    public function store($competence, $constructions){
        dd("Envio de e-mail está em construção.");
    }
}
