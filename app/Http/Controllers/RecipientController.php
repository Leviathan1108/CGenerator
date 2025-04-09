<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;
use App\Models\Certificate;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipient::with('certificate')->get(); // Ambil data dengan sertifikat
        return view('recipients.index', compact('recipients'));
    }

    public function create()
    {
        $certificates = Certificate::all(); // Ambil semua sertifikat
        return view('recipients.create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'name' => 'required',
            'email' => 'required|email|unique:recipients,email',
        ]);

        Recipient::create($request->all());

        return redirect()->route('recipients.index')->with('success', 'Recipient created successfully.');
    }

    public function edit(Recipient $recipient)
    {
        $certificates = Certificate::all();
        return view('recipients.edit', compact('recipient', 'certificates'));
    }

    public function update(Request $request, Recipient $recipient)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'name' => 'required',
            'email' => 'required|email|unique:recipients,email,' . $recipient->id . ',id',
        ]);

        $recipient->update($request->all());

        return redirect()->route('recipients.index')->with('success', 'Recipient updated successfully.');
    }

    public function destroy(Recipient $recipient)
    {
        $recipient->delete();
        return redirect()->route('recipients.index')->with('success', 'Recipient deleted successfully.');
    }
}
