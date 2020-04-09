<?php

use App\Models\UploadStatus;
use Illuminate\Database\Seeder;

class UploadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UploadStatus::create([
            'name' => 'Não processado',
            'status' => 1
        ]);
        UploadStatus::create([
            'name' => 'Ok',
            'status' => 1
        ]);
        UploadStatus::create([
            'name' => 'Erro no processamento',
            'status' => 1
        ]);
        UploadStatus::create([
            'name' => 'Aguardando Aprovação',
            'status' => 1
        ]);
    }
}
