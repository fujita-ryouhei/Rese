<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
