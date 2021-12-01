<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }


    public function users(){
        return view('admin.users');
    }


    public function waste(){
        return view('admin.waste');
    }
}