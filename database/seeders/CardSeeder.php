<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DB::table('cards')->create([
                'user_id' => 1,
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'title' => fake()->jobTitle(),
                'id_code' => fake()->generateRandomId(),
                'contact' => '09' . rand(100000000, 999999999),
                'blood_type' => fake()->bloodGroup(),
            ]);
        }
    }
}
