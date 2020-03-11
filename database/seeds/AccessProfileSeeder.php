<?php

use App\Models\AccessProfile;
use Illuminate\Database\Seeder;

class AccessProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessProfile::create([
            'name'=>'Admin',
        ]);


        AccessProfile::create([
            'name'=>'Cliente',
        ]);
    }
}
