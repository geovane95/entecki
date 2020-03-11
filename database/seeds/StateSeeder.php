<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name'=>'Acre',
            'initials' => 'AC',
            'status' => 1
        ]);
        State::create([
            'name'=>'Alagoas',
            'initials' => 'AL',
            'status' => 1
        ]);
        State::create([
            'name'=>'Amapá',
            'initials' => 'AP',
            'status' => 1
        ]);
        State::create([
            'name'=>'Amazonas',
            'initials' => 'AM',
            'status' => 1
        ]);
        State::create([
            'name'=>'Bahia',
            'initials' => 'BA',
            'status' => 1
        ]);
        State::create([
            'name'=>'Ceará',
            'initials' => 'CE',
            'status' => 1
        ]);
        State::create([
            'name'=>'Distrito Federal',
            'initials' => 'DF',
            'status' => 1
        ]);
        State::create([
            'name'=>'Espírito Santo',
            'initials' => 'ES',
            'status' => 1
        ]);
        State::create([
            'name'=>'Goiás',
            'initials' => 'GO',
            'status' => 1
        ]);
        State::create([
            'name'=>'Maranhão',
            'initials' => 'MA',
            'status' => 1
        ]);
        State::create([
            'name'=>'Mato Grosso',
            'initials' => 'MT',
            'status' => 1
        ]);
        State::create([
            'name'=>'Mato Grosso do Sul',
            'initials' => 'MS',
            'status' => 1
        ]);
        State::create([
            'name'=>'Minas Gerais',
            'initials' => 'MG',
            'status' => 1
        ]);
        State::create([
            'name'=>'Pará',
            'initials' => 'PA',
            'status' => 1
        ]);
        State::create([
            'name'=>'Paraíba',
            'initials' => 'PB',
            'status' => 1
        ]);
        State::create([
            'name'=>'Paraná',
            'initials' => 'PR',
            'status' => 1
        ]);
        State::create([
            'name'=>'Pernambuco',
            'initials' => 'PE',
            'status' => 1
        ]);
        State::create([
            'name'=>'Piauí',
            'initials' => 'PI',
            'status' => 1
        ]);
        State::create([
            'name'=>'Rio de Janeiro',
            'initials' => 'RJ',
            'status' => 1
        ]);
        State::create([
            'name'=>'Rio Grande do Norte',
            'initials' => 'RN',
            'status' => 1
        ]);
        State::create([
            'name'=>'Rio Grande do Sul',
            'initials' => 'RS',
            'status' => 1
        ]);
        State::create([
            'name'=>'Rondônia',
            'initials' => 'RO',
            'status' => 1
        ]);
        State::create([
            'name'=>'Roraima',
            'initials' => 'RR',
            'status' => 1
        ]);
        State::create([
            'name'=>'Santa Catarina',
            'initials' => 'SC',
            'status' => 1
        ]);
        State::create([
            'name'=>'São Paulo',
            'initials' => 'SP',
            'status' => 1
        ]);
        State::create([
            'name'=>'Sergipe',
            'initials' => 'SE',
            'status' => 1
        ]);
        State::create([
            'name'=>'Tocantins',
            'initials' => 'TO',
            'status' => 1
        ]);

    }
}
