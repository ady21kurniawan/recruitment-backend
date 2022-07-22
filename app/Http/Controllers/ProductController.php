<?php

namespace App\Http\Controllers;

use App\Models\{product_details, products, categories};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list_products($page=1)
    {
        if($page < 1)
        {
            $page =1;
        }
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        
        $data = $this->product_builder()
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray()
        ;    
  
        return custom_response(true,"success",null,$data);
    }

    public function detail_products($product_id)
    {
        if(! $product_id )
        {
            return custom_response(false,null, "product id required");
        }

        $data = $this->product_builder()
            ->whereProductId($product_id)
            ->first()
        ;
        
        if( ! $data )
        {
            return custom_response(false,null, "product not found with this id ({$product_id})");
        }
        
        return custom_response(true,"success", null, $data->toArray());
    }

    public function sorting_product($column = 'id', $sort ='asc')
    {
        $data = $this->product_builder()
            ->orderBy($column,$sort)
            ->get()
            ->toArray()
        ;
        return custom_response(true,"success", null, $data);    

    }

    public function list_category()
    {
        $data = categories::query()
            ->join("product_details", "product_details.category_id", "categories.id")
            ->join("products", "product_details.product_id", "products.id")
            ->selectRaw("categories.category_name, count(categories.category_name) as total_product")
            ->groupBy("categories.category_name")
            ->get()
            ->toArray()
        ;
        return custom_response(true,"success", null, $data); 
    }

    public function product_builder()
    {
        $query = products::query()
            ->join("product_details", "products.id", "product_details.product_id")
            ->join("categories","product_details.category_id","categories.id")
            ->select("products.id","product_name","category_name","stock","price")
        ;
        return $query;

    }
}
