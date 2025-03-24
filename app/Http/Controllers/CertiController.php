<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertiController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }
}

?>