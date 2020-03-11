<?php

use App\Models\Responsible;
use Illuminate\Database\Seeder;

class ResponsibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Responsible::create([
            'company_name' => 'Juh Camillo web',
            'cnpj' => '87653674000176',
            'status' => 1
        ]);
        Responsible::create([
            'company_name' => 'KEDGE Serviços de Informática',
            'cnpj' => '87653245000176',
            'status' => 1
        ]);
        Responsible::create([
            'company_name' => 'Umeet Soluções',
            'cnpj' => '87343674000176',
            'status' => 1
        ]);
    }
}
