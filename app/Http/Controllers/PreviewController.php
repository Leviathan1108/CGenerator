<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Contact;
class PreviewController extends Controller
{
    public function index()
    {
        $template = Template::latest()->first(); // Ambil template terbaru
        $contacts = Contact::all();              // Ambil semua nama dan email

        return view('layout.preview', compact('template', 'contacts'));
    }
}
