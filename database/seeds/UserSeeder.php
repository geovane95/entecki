<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'company' => 'Umeet',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('123456789'), // password
            'access_profile' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Cliente',
            'company' => 'Entecki',
            'email' => 'cliente@cliente.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('123456789'), // password
            'access_profile' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Lucas Souza de Andrade',
            'company' => 'Umeet',
            'email' => 'lucascorporation@live.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('Linux_Ferrari'), // password
            'access_profile' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Cliente 2',
            'company' => 'Entecki',
            'email' => 'cliente2@cliente.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('123456789'), // password
            'access_profile' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Cliente3',
            'company' => 'Entecki',
            'email' => 'cliente3@cliente.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('123456789'), // password
            'access_profile' => 2,
            'remember_token' => Str::random(10),
        ]);
    }
}
