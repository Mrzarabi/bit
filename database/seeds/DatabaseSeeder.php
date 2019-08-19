<?php

use Illuminate\Database\Seeder;
use Ybazli\Faker\Facades\Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh');

            $this->command->line("Database cleared.");
        }

        $this->call(OptionTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        $this->call(LaratrustSeeder::class);
        // $this->call(SubjectTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(SpecTableSeeder::class);

        $this->command->info("Database seeded.");

        // Re Guard model
        Eloquent::reguard();
    }
}
