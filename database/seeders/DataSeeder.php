<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('data')->insert([
            'uuid' => $faker->uuid,
            'nama' => $faker->name,
            'phone' => $faker->phoneNumber,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
