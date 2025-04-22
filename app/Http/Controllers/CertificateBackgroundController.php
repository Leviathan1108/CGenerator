<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateBackground;

class CertificateBackgroundController extends Controller
{
    public function index()
    {
        return view('layout.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'background' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);
    
        $path = $request->file('background')->store('backgrounds', 'public');
    
        // Simpan ke database jika perlu
        // Background::create(['file_path' => $path]);
    
        return back()->with('success', 'Background berhasil diunggah!');
    }
}
