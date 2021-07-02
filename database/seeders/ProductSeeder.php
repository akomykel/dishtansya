<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Adobo kangkong',
                'available_stock' => 10,
            ],
            [
                'name' => 'Kare-Kare',
                'available_stock' => 45,
            ],
            [
                'name' => 'Chopsuey',
                'available_stock' => 80,
            ]
        ]);
    }
}
