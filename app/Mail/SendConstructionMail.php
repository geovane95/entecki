<?php

namespace App\Mail;

use App\Models\Address;
use App\Models\Location;
use App\Models\City;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\Business;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendConstructionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cores = [
            'WA' => ['FAROL' => 'vermelho', 'ALT' => 'Condições Criticas', 'TITLE' => 'Condições Criticas'],
            'OK' => ['FAROL' => 'verde', 'ALT' => 'Condições Ideais', 'TITLE' => 'Condições Ideais'],
            'AL' => ['FAROL' => 'amarelo', 'ALT' => 'Condições de Alerta', 'TITLE' => 'Condições de Alerta']
        ];
        $data = DB::table('constructions')
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
                'businesses.name as business_name',
                'constructions.contract_regime',
                'constructions.reporting_regime as report_regime',
                'constructions.work_number',
                'constructions.responsible as responsible_name',
                'constructions.cnpj as responsible_cnpj',
                'constructions.status as construction_status',
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
                'data.ACUMCONTR',
                'data.CUSTOP',
                'data.PRAZO',
                'data.FLUXOD',
                'data.QUALIDADE',
                'data.SEGORG',
                'data.MAMBI',
                'data.DATAEMISSAO',
                'upload_data.competence'
            )->where([
                'data.id' => $this->data
            ])
            ->get();
        return $this
            ->subject('Entecki - Relatório de Empreendimento')
            ->view('area-do-cliente.mail.email')
            ->with([
                'obra' => $data[0]->construction_name,
                'foto' => $data[0]->thumbnail,
                'construtora' => $data[0]->company,
                'localregiao' => $data[0]->neighborhood,
                'cidadeestado' => $data[0]->city.'/'.$data[0]->state,
                'razaosocial' => $data[0]->responsible_name,
                'cnpj' => $data[0]->responsible_cnpj,
                'endereco' => $data[0]->street.", ".$data[0]->number,
                'regimecontrato' => $data[0]->contract_regime,
                'regimerelatorio' => $data[0]->report_regime,
                'dataemissao' => $data[0]->DATAEMISSAO,
                'obran' => $data[0]->work_number,
                'mesreferencia' => $data[0]->description,
                'status' => $data[0]->construction_status ? 'Em andamento' : 'Finalizada',
                'acumcontr' => $data[0]->ACUMCONTR.'%',
                'CUSTOP' => $cores[$data[0]->CUSTOP],
                'PRAZO' => $cores[$data[0]->PRAZO],
                'FLUXOD' => $cores[$data[0]->FLUXOD],
                'QUALIDADE' => $cores[$data[0]->QUALIDADE],
                'SEGORG' => $cores[$data[0]->SEGORG],
                'MAMBI' => $cores[$data[0]->MAMBI]
            ]);
    }
}
