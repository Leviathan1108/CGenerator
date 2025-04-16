<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Certificate;
use Illuminate\Support\Facades\Hash;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = User::where('role', 'recipient')->with('certificate')->get();
        return view('recipients.index', compact('recipients'));
    }

    public function create()
    {
        $certificates = Certificate::all();
        return view('recipients.create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'certificate_id' => $request->certificate_id,
            'role' => 'recipient',
            'password' => Hash::make('default_password') // Ganti default password jika perlu
        ]);

        return redirect()->route('recipients.index')->with('success', 'Penerima berhasil ditambahkan.');
    }

    public function edit(User $recipient)
    {
        $certificates = Certificate::all();
        return view('recipients.edit', compact('recipient', 'certificates'));
    }

    public function update(Request $request, User $recipient)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $recipient->id,
        ]);

        $recipient->update([
            'name' => $request->name,
            'email' => $request->email,
            'certificate_id' => $request->certificate_id,
        ]);

        return redirect()->route('recipients.index')->with('success', 'Penerima berhasil diperbarui.');
    }

    public function destroy(User $recipient)
    {
        $recipient->delete();
        return redirect()->route('recipients.index')->with('success', 'Penerima berhasil dihapus.');
    }
}
?>