<?php

use App\Models\CarType;
use App\Models\PriceMinute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $priceMinute = PriceMinute::first() ?? new PriceMinute();
        $priceMinute->price = 0.5;
        $priceMinute->save();

        DB::table('car_type')->delete();
        for ($i = 0; $i < 5; $i++) {
            DB::table('car_type')->insert([
                'name' => Str::random(10),
                'feed' => rand(1, 10),
            ]);
        }       

        DB::table('parking')->delete();

        for ($i = 0,  $carTypes = CarType::all(); $i < 10; $i++) {

            $carIn = now()->addMinutes(rand(1, 20));
            $carOut = (clone $carIn)->addMinutes(rand(1, 20));

            $carType = $carTypes[rand(0, count($carTypes) - 1)];

            $minutes = $carOut->diffInMinutes($carIn);

            DB::table('parking')->insert([
                'plate' => Str::random(7),
                'car_in' => $carIn,
                'car_out' => $carOut,
                'amount' => round($minutes * 0.5 + $carType->feed, 2),
                'car_type_id' => $carType->id,
            ]);
        }
    }
}
