<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
    return view('pages.home');
    }
    public function manga()
    {
    return view('pages.manga');
    }
    public function manhwa()
    {
    return view('pages.manhwa');
    }
    public function manhua()
    {
    return view('pages.manhua');
    }
    public function search()
    {
    return view('pages.search');
    }
    public function in4truyen()
    {
    return view('pages.info');
    }
}