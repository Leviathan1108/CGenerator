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
        $certificates = Certificate::all(); // Ambil semua sertifikat untuk dropdown
        return view('verifications.create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'verification_code' => 'required|unique:certificate_verifications,verification_code',
            'verified_by' => 'required|string|max:255',
        ]);

        Verification::create([
            'certificate_id' => $request->certificate_id,
            'verification_code' => $request->verification_code,
            'verified_at' => now(),
            'verified_by' => $request->verified_by,
        ]);

        return redirect('/verifications')->with('success', 'Verifikasi berhasil ditambahkan!');
    }
}
