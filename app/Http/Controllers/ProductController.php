<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->repo = new ProductRepository( new \App\Models\products() );
    }

    protected function list_products($page = 1)
    {
        $page = $page < 1 || $page == null ? 1 : $page;
        $results = $this->repo->list($page);
        return custom_response(true,"success",null,$results);
    }

    protected function detail_products($product_id = null)
    {
        $result = $this->repo->details($product_id);
        if($result instanceof \Exception)
        {
            return custom_response(false,null,$result->getMessage());
        }
        return custom_response(true,"success", null, $result);
    }

    public function sorting_product($column = 'id', $sort ='asc')
    {
        $results = $this->repo->sort([
            "column" => $column,
            "sort" => $sort
        ]);
        return custom_response(true,"success", null, $results);
    }
}
