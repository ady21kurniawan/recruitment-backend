<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\{products , categories};

class ProductRepository
{
    public function __construct( \App\Models\products $model )
    {
        $this->model = $model;
    }

    public function list( $page )
    {
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        
        $data = $this->product_builder()
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray()
        ;    
        return $data;
    }

    public function details( $product_id )
    {
        if(! $product_id )
        {
            return new \Exception("product id required");
        }

        $data = $this->product_builder()
            ->whereProductId($product_id)
            ->first()
        ;
        
        if( ! $data )
        {
            return new \Exception("product not found with this id ({$product_id})");
        }
        return $data->toArray();
    }

    public function sort( $data )
    {
        $data = $this->product_builder()
            ->orderBy($data["column"],$data["sort"])
            ->get()
            ->toArray()
        ;
        return $data;
    }

    private function product_builder()
    {
        $query = $this->model::query()
            ->join("product_details", "products.id", "product_details.product_id")
            ->join("categories","product_details.category_id","categories.id")
            ->select("products.id","product_name","category_name","stock","price")
        ;
        return $query;

    }
}
