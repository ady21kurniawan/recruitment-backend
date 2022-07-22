<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\product_details;

class product_details_seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_products = [
            [1, 1, 10, 150000 ],
            [2, 1, 20, 250000 ],
            [3, 1, 30, 350000 ],
            [4, 1, 40, 450000 ],
            [5, 2, 50, 550000 ],
            [6, 2, 60, 650000 ],
            [7, 3, 70, 750000 ],
            [8, 3, 80, 850000 ],
            [9, 3, 90, 950000 ],
            [10, 3, 100, 1050000 ],
            [11, 4, 110, 1150000 ],
            [12, 4, 120, 1250000 ],
            [13, 4, 130, 1350000 ]
        ];

        foreach($detail_products as $detail)
        {
            product_details::create([
                "product_id" => $detail[0],
                "category_id" => $detail[1],
                "stock" => $detail[2],
                "price" => $detail[3]
            ]);
        }
    }
}
