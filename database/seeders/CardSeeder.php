<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $userIds = User::all()->pluck('id');

        // foreach ($userIds as $id) {
        //     DB::table('')
        // }
        for ($i = 0; $i < 15; $i++) {
            DB::table('cards')->insert([
                'user_id' => 1,
                'first_name' => strtoupper(fake()->firstName()),
                'last_name' => strtoupper(fake()->lastName()),
                'title' => implode(' ', array_slice(explode(' ', fake()->jobTitle()), 0, 3)),
                'id_code' => implode('-', str_split(strtoupper(Str::random(8)), 2)),
                'contact' => '09' . rand(100000000, 999999999),
                'blood_type' => fake()->bloodGroup(),
                'created_at' => now(),
                'deleted_at' => rand(0, 1) ? now() : null
            ]);
        }
    }
}
