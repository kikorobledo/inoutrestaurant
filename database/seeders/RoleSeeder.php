<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Spatie\Permission\Guard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'guard_name' => Guard::getDefaultName(static::class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'Administrador Tienda',
            'guard_name' => Guard::getDefaultName(static::class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'Empleado',
            'guard_name' => Guard::getDefaultName(static::class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'Empleado Especial',
            'guard_name' => Guard::getDefaultName(static::class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
