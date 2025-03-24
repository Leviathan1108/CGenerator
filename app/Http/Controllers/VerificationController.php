<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;

class VerificationController extends Controller
{
    public function index()
    {
        $verifications = Verification::all();
        return view('verifications.index', compact('verifications'));
    }
}

?>