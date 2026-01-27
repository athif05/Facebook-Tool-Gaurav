<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermController extends Controller
{
    public function show()
    {
        return view('terms');
    }
}
