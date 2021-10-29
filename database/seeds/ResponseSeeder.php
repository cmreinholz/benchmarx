<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Response;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::select('id')->get();

        $faker = Faker\Factory::create();
        foreach ($users as $user) {
            DB::table('responses')->insert(
                [
                    'question_id' => '12',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => json_encode($faker->randomElements($array = ['Irrigation Service', 'Irrigation Install', 'Lawn Mowing', 'Lawn Fertilization', 'Snow Removal\/Deicing', 'Landscape Design\/Build', 'Landscape Lighting', 'Arbor Care', 'Pest Control'], $count = $faker->numberBetween(1, 9))),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            DB::table('responses')->insert(
                [
                    'question_id' => '11',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => $faker->numberBetween($min = 20000, $max = 50000000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            DB::table('responses')->insert(
                [
                    'question_id' => '15',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => $faker->year($max = 'now'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            DB::table('responses')->insert(
                [
                    'question_id' => '14',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => $faker->randomElement($array = ['Blue', 'Green', 'Purple', 'Yellow', 'Black']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $revenue = Response::select('response')->where('user_id', '=', $user->id)->where('question_id', '=', '11')->where('year', '=', now()->year)->get();
            
            $highend = $revenue[0]->response * .6;
            
            DB::table('responses')->insert(
                [
                    'question_id' => '13',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => $faker->numberBetween($min = 0, $max = $highend),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $profit = Response::select('response')->where('user_id', '=', $user->id)->where('question_id', '=', '13')->where('year', '=', now()->year)->get();
            //dd($profit[0]->response);
            DB::table('responses')->insert(
                [
                    'question_id' => '17',
                    'user_id' => $user->id,
                    'year' => now()->year,
                    'response' => number_format((float)($profit[0]->response) / ($revenue[0]->response)*100, 2, '.', ''),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

        }

        //$faker->randomElements($array = array ()), $count = 3
    }
}
