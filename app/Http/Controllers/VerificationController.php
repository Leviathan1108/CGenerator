<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class VerificationController extends Controller
{
    public function index()
    {
        return view('verifications.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string'
        ]);

        return redirect()->route('verifications.show', ['code' => $request->verification_code]);
    }

    public function show($code)
    {
        $certificate = Certificate::where('verification_code', $code)->first();

        if (!$certificate) {
            return response()->view('verifications.not-found', [], 404);
        }

        return view('verifications.show', compact('certificate'));
    }
}
