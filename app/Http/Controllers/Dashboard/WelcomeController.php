<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use App\Client;
use App\User;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();


    return view('dashboard.welcome', compact('categories_count', 'products_count','clients_count', 'users_count'));

    }
}
