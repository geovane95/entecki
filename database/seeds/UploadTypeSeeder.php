<?php

use App\Models\UploadType;
use Illuminate\Database\Seeder;

class UploadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UploadType::create([
            'name'=> 'Informações de Obra',
            'status'=>1
        ]);
        UploadType::create([
            'name' => 'Documentos de Obra',
            'status' => 1
        ]);
        UploadType::create([
            'name' => 'Arquivo de Fotos',
            'status' => 1
        ]);
        UploadType::create([
            'name' => 'Relatório de Obra',
            'status' => 1
        ]);
    }
}
