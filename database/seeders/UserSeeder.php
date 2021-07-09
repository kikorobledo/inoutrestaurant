<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Guard;
use App\Models\Establishment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_number' => 1,
            'name' => 'Kiko',
            'email' => 'correo@correo.com',
            'email_verified_at' => Carbon::now(),
            'role'=> 1,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'user_number' => 2,
            'name' => 'May',
            'email' => 'correo2@correo.com',
            'email_verified_at' => Carbon::now(),
            'role'=> 2,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'user_number' => 3,
            'name' => 'Javi',
            'email' => 'correo3@correo.com',
            'email_verified_at' => Carbon::now(),
            'role'=> 2,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('users')->insert([
            'user_number' => 4,
            'name' => 'Fer',
            'email' => 'correo4@correo.com',
            'email_verified_at' => Carbon::now(),
            'role'=> 2,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'user_number' => 5,
            'name' => 'Agus',
            'email' => 'correo5@correo.com',
            'email_verified_at' => Carbon::now(),
            'role'=> 2,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $users = User::all();
        foreach ($users as $user) {
            $user->roles()->attach(2);
            Establishment::create(['user_id' => $user->id]);
        }

        User::first()->roles()->sync(1);
    }
}
