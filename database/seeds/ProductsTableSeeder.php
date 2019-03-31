<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Products Table Seeder
        $unixTimestamp = '1554021127'; // = 03/31/2019 Time stamp
        for($i=1;$i<=10;$i++){
            $fdate = $faker->dateTime($unixTimestamp);
            DB::table('products')->insert([
                'product_name' => Str::random(10),
                'quantity_in_stock' => $faker->randomDigit,
                'price_per_item' => $faker->randomDigit,
                'created_at' => $fdate,
                'updated_at' => $fdate,
            ]);
        }
    }
}
