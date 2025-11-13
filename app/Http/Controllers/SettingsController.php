<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show connections page
     */
    public function connections()
    {
        return view('settings.connections');
    }

    /**
     * Show ad accounts page
     */
    public function adAccounts()
    {
        return view('settings.ad-accounts');
    }
}