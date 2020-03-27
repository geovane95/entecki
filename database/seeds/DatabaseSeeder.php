<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessProfileSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UploadStatusSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(UploadTypeSeeder::class);
        $this->call(ResponsibleSeeder::class);
        $this->call(RegionalSeeder::class);
        $this->call(ConstructionSeeder::class);
        $this->call(UserToConstructionSeeder::class);
    }
}
