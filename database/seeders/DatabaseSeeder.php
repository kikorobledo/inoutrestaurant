<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ExtraSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(ExtraSeeder::class);
    }
}
