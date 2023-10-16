<?php

namespace App\Http\Controllers;

use App\Models\CategoryProducts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CategoryProducts::all();
        $compacts = [
            'categories' => $categories
        ];
        return view('web.index',$compacts);
    }
}
