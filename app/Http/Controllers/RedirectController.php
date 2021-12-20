<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for redirecting the user to the right dashboard
 */
class RedirectController extends Controller
{
    /**
 * Redirects to the correct dashboard
 */
    public function findHome(){

        $role = Auth::user()->role;

        if($role == '1'){
            
           return redirect()->route('admin.dashboard');

        }else if($role == '0'){

            return redirect()->route('user.dashboard');

        }

        
        return redirect()->back();
    }
}