<?php

namespace App\Http\Controllers;

use App\Models\Waste;
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

        $wastes = Waste::latest()->paginate(10);

        return view('admin.waste' , compact(['wastes']));
    }
}