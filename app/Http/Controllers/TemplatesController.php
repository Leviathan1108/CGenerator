<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplatesController extends Controller
{
    public function index() 
    {
        return view('templates');
    }
}
?>