<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendCodeController extends Controller
{
    public function store(Request $request)
    {
        // Simulasikan logika kirim kode ke email di sini
        // Misalnya:
        Mail::to($request->email)->send(new SendSecurityCode());

        return redirect()->route('code.form');
    }
}
?>