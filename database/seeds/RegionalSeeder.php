<?php

use App\Models\Regional;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Regional::create([
            'name' => 'São Paulo - Centro',
            'status' => 1
        ]);
        Regional::create([
            'name' => 'São Paulo - Zona Norte',
            'status' => 1
        ]);
        Regional::create([
            'name' => 'Campinas Centro',
            'status' => 1
        ]);
    }
}
