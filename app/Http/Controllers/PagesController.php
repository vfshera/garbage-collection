<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for Site Pages
 */
class PagesController extends Controller
{
    public function index(){



        return view('welcome');
    }
}