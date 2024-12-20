<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use ZipArchive;
class AdminController extends Controller
{
    //
    public function home()
    {
        return view('admin.home');
    }
}