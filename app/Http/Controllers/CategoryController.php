<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->repo = new CategoryRepository( new \App\Models\categories() );
    }

    public function list_category()
    {
        $results = $this->repo->lists();
        return custom_response(true,"success", null, $results); 
    }
}
