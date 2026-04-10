<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowController extends Controller
{
    public function jumlahUser(){
        $data = User::all();
        return view('admin.dashboard', compact('data'));
    }
}
