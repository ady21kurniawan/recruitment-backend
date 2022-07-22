<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\products;

class product_seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_products = ['televisi', 'radio','kulkas','ac','t-shirt','jeans','jam tangan','smart watch','gelang','kalung','mobil','motor','sepeda'];

        foreach($list_products as $product)
        {
            products::create([
                "product_name" => $product
            ]);
        }
    }
}
