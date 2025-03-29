<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Certificate;

class VerificationController extends Controller
{
    public function index()
    {
        $verifications = Verification::with('certificate')->get();
        return view('verifications.index', compact('verifications'));
    }

    public function create()
    {
        return view('verifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|exists:certificates,verification_code',
            'verified_by' => 'required|string|max:255',
        ]);

        Verification::create([
            'verification_code' => $request->verification_code,
            'verified_at' => now(),
            'verified_by' => $request->verified_by,
        ]);

        return redirect('/verifications')->with('success', 'Verifikasi berhasil ditambahkan!');
    }
}
