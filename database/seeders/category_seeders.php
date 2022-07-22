<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\categories;

class category_seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'elektonik',
            'fashion',
            'aksesoris',
            'kendaraan'
        ];

        foreach($categories as $category)
        {
            categories::create([
                "category_name" => $category
            ]);
        }
    }
}
