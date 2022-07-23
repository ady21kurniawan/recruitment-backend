<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CategoryRepository 
{
    public function __construct( \App\Models\categories $model )
    {
        $this->model = $model;
    }

    public function lists()
    {
        $data = $this->model::query()
            ->join("product_details", "product_details.category_id", "categories.id")
            ->join("products", "product_details.product_id", "products.id")
            ->selectRaw("categories.category_name, count(categories.category_name) as total_product")
            ->groupBy("categories.category_name")
            ->get()
            ->toArray()
        ;
        //return custom_response(true,"success", null, $data);
        return $data; 
    }

}
