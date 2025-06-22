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
            'verification_code' => 'required|string',
        ]);

        $certificate = Certificate::where('verification_code', $request->verification_code)->first();

        if (!$certificate) {
            return back()->with('error', 'Verification code not found.');
        }

        return view('certificates.result', compact('certificate'));
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
