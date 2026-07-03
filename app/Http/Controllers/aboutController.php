<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class aboutController extends Controller
{
    public function index()
    {
        return view('about.index');
    }
}
