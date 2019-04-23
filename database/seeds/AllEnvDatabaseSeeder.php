<?php

use Illuminate\Database\Seeder;

class AllEnvDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GendersTableSeeder::class);
    }
}
