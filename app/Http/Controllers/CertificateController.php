<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;
use App\Models\Recipient;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with('recipient')->get();
        return view('certificates.index', compact('certificates'));        
    }

    public function create()
    {
        $templates = Template::all();
        $recipients = Recipient::all();
        return view('certificates.create', compact('templates', 'recipients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'recipient_id' => 'required|exists:recipients,id',
            'issued_date' => 'required|date',
            'status' => 'required|in:draft,published,revoked',
        ]);

        Certificate::create([
            'template_id' => $request->template_id,
            'recipient_id' => $request->recipient_id,
            'issued_date' => $request->issued_date,
            'status' => $request->status,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate berhasil dibuat!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        $templates = Template::all();
        $recipients = Recipient::all();
        return view('certificates.edit', compact('certificate', 'templates', 'recipients'));
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'recipient_id' => 'required|exists:recipients,id',
            'issued_date' => 'required|date',
            'status' => 'required|in:draft,published,revoked',
        ]);

        $certificate->update($request->all());

        return redirect()->route('certificates.index')->with('success', 'Certificate berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return redirect()->route('certificates.index')->with('success', 'Certificate berhasil dihapus!');
    }
}
