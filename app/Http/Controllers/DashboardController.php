<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index

    public function index() {
        $name = 'Admin';

        return view('dashboard', ['nama' => $name]);
    }
}