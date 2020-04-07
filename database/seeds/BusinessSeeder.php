<?php

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name' => 'Juh Camillo web',
            'status' => 1
        ]);
        Business::create([
            'name' => 'KEDGE Serviços de Informática',
            'status' => 1
        ]);
        Business::create([
            'name' => 'Umeet Soluções',
            'status' => 1
        ]);
    }
}
