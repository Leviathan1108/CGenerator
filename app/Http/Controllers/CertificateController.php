<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;
use Illuminate\Support\Str;
use App\Models\User;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with('user')->get();
        $templates = Template::all();
        return view('templateadmin.index', compact('templates'));        
    }

    public function create()
    {
        $templates = Template::all();
        return view('templateadmin.create', compact('templates'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'background_choice' => 'required|in:custom,template',
            'selected_template_id' => 'nullable|exists:templates,id',
            'status' => 'required|in:draft,published,revoked',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'participant_name' => 'required|string|max:255',
            'selected_template_id' => $request->background_choice === 'template'
            ? 'required|exists:templates,id'
            : 'nullable',
        ]);

        $uid = Str::uuid();
        $verificationCode = strtoupper(Str::random(10));

        // Cek dan buat user kalau belum ada
        $user = User::where('name', $request->participant_name)->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->participant_name,
                'email' => Str::slug($request->participant_name) . '-' . Str::random(5) . '@example.com',
                'password' => bcrypt(Str::random(10)),
            ]);
        }

        // Upload logo jika ada
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $certificate = Certificate::create([
            'selected_template_id' => $request->selected_template_id ?? 0,
            'user_id' => $user->id,
            'uid' => $uid,
            'verification_code' => $verificationCode,
            'background_choice' => $request->background_choice,
            'event_name' => $request->event_name,
            'logo_path' => $logoPath,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sertifikat dan peserta berhasil disimpan',
            'data' => [
                'certificate_id' => $certificate->id,
                'participant_id' => $user->id,
            ]
        ]);
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        $templates = Template::all();
        return view('templateadmin.edit', compact('certificate', 'templates'));
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'issued_date' => 'required|date',
            'status' => 'required|in:draft,published,revoked',
        ]);

        $certificate->update($request->all());

        return redirect()->route('templateadmin.index')->with('success', 'Certificate berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return redirect()->route('templateadmin.index')->with('success', 'Certificate berhasil dihapus!');
    }

    public function preview($id)
    {
        $certificate = Certificate::with('template', 'user')->findOrFail($id);

        $data = [
            'name' => $certificate->user->name,
            'event' => $certificate->event_name,
        ];

        return view('templateadmin.preview', [
            'data' => $data,
            'logo' => $certificate->template->logo_path ?? null,
            'background' => $certificate->template->background_choice ?? null,
        ]);
    }

    public function download($id)
    {
        $certificate = Certificate::with('template')->findOrFail($id);
        $pdf = \PDF::loadView('templateadmin.pdf', compact('certificate'));
        return $pdf->download("templateadmin-{$certificate->uid}.pdf");
    }
    public function upload()
    {
        return view('layout.upload');
    }
    public function template()
    {
        $templates = Template::all();
        return view('layout.template', compact('templates'));
    }              
}
?>