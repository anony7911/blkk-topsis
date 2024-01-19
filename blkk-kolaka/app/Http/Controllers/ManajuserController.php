<?php

namespace App\Http\Controllers;

use App\Models\User;

class ManajuserController extends Controller
{
    public function index()
    {
        $manajusers = User::all();
        return view('manajuser', compact('manajusers'));
    }
}
