<?php

use App\Models\UsersToConstructions;
use Illuminate\Database\Seeder;

class UserToConstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersToConstructions::create([
            'user' => 2,
            'construction' => 1
        ]);
        UsersToConstructions::create([
            'user' => 4,
            'construction' => 2
        ]);
        UsersToConstructions::create([
            'user' => 5,
            'construction' => 3
        ]);
        UsersToConstructions::create([
            'user' => 2,
            'construction' => 3
        ]);
        UsersToConstructions::create([
            'user' => 1,
            'construction' => 1
        ]);
        UsersToConstructions::create([
            'user' => 1,
            'construction' => 2
        ]);
        UsersToConstructions::create([
            'user' => 1,
            'construction' => 3
        ]);
        UsersToConstructions::create([
            'user' => 1,
            'construction' => 4
        ]);
    }
}
