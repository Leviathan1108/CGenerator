<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        $templates = Template::all();
        $recipients = Recipient::all();
        $users = User::all();
        return view('certificates.create', compact('templates', 'recipients', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'recipient_id' => 'required|exists:recipients,recipient_id',
            'issued_by' => 'nullable|exists:users,id',
            'issue_date' => 'required|date',
            'status' => 'required|in:draft,published,revoked',
        ]);

        Certificate::create([
            'template_id' => $request->template_id,
            'recipient_id' => $request->recipient_id,
            'issued_by' => $request->issued_by,
            'issue_date' => $request->issue_date,
            'status' => $request->status,
            'verification_code' => Str::upper(Str::random(10)),
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate successfully created!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        $templates = Template::all();
        $recipients = Recipient::all();
        $users = User::all();
        return view('certificates.edit', compact('certificate', 'templates', 'recipients', 'users'));
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'recipient_id' => 'required|exists:recipients,recipient_id',
            'issued_by' => 'nullable|exists:users,id',
            'issue_date' => 'required|date',
            'status' => 'required|in:draft,published,revoked',
        ]);

        $certificate->update([
            'template_id' => $request->template_id,
            'recipient_id' => $request->recipient_id,
            'issued_by' => $request->issued_by,
            'issue_date' => $request->issue_date,
            'status' => $request->status,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully!');
    }
}

?>