<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function done()
    {
        return view('done');
    }

    public function menu1()
    {
        return view('menu1');
    }

    public function menu2()
    {
        return view('menu2');
    }

    public function mypage()
    {
        return view('mypage');
    }
}
