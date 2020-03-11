<?php

namespace App\Mail;

use App\Models\Address;
use App\Models\City;
use App\Models\Competence;
use App\Models\Construction;
use App\Models\Data;
use App\Models\Responsible;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Location;

class SendConstructionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $construction, $competence;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Construction $construction,Competence $competence)
    {
        $this->construction = $construction;
        $this->competence = $competence;
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
        $constructionId = 1; //Receber esse parametro dinamicamente
        $competenceId = 1; //Receber esse parametro dinamicamente
        $construction = Construction::find($constructionId);
        $address = Address::find($construction->address);
        $location = Location::find($address->location);
        $city = City::find($location->city);
        $state = State::find($city->state);
        $responsible = Responsible::find($construction->responsible);
        $data = Data::get()->where([
            ['construction','=',$constructionId],
            ['competence', '=', $competenceId],
        ]);
        $competence = Competence::find($data->competence);
        return $this
            ->from('geovane.a.f.junior@gmail.com')
            ->subject('Entecki - Relatório de Empreendimento')
            ->view('area-do-cliente.mail.email')
            ->with([
                'obra' => $construction->name,
                'construtora' => $construction->company,
                'localregiao' => $location->neighborhood,
                'cidadeestado' => $city->name.'/'.$state->name,
                'razaosocial' => $responsible->company_name,
                'cnpj' => $responsible->cnpj,
                'endereco' => $address->street.", ".$address->number,
                'regimecontrato' => $construction->contract_regime,
                'regimerelatorio' => $construction->report_regime,
                'dataemissao' => $construction->issuance_date,
                'obran' => $construction->work_number,
                'mesreferencia' => $competence->description,
                'status' => $construction->status ? 'Em andamento' : 'Finalizada',
                'acumcontr' => $data->ACUMCONTR.'%',
                'CUSTOP' => $cores[$data->CUSTOP],
                'PRAZO' => $cores[$data->PRAZO],
                'FLUXOD' => $cores[$data->FLUXOD],
                'QUALIDADE' => $cores[$data->QUALIDADE],
                'SEGORG' => $cores[$data->SEGORG],
                'MAMBI' => $cores[$data->MAMBI]
            ]);
    }
}
