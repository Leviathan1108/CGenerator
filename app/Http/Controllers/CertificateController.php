<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\User;
use App\Models\CertificateBackground;
use Illuminate\Support\Facades\Storage;
use App\Mail\CertificateMail;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with('user')->get();
        $templates = Template::all();
        return view('templateadmin.index', compact('templates'));        
    }

    public function show_certificate()
    {
        $certificate = Certificate::all();
        return view('certificates.view', compact('certificate'));
    }

    public function create()
    {
        $templates = Template::all();
        return view('templateadmin.create', compact('templates'));
    }

    public function template()
    {
        $templates = Template::all();
        $contacts = Contact::all(); // Ambil semua kontak
        return view('layout.template', compact('templates', 'contacts'));
    }
    
// Controller

public function dataInputs($id)
{
    $certificate = Certificate::with('template', 'contact')->findOrFail($id);
    $contacts = Contact::all(); // Ambil semua kontak

    return view('layout.previewtemplate', compact('certificate', 'contacts'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'certificate_type' => 'nullable|string|max:100',        'date' => 'required|date',
        'description' => 'nullable|string|max:1000',
        'signatureImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'signature_name' => 'required|string|max:255',
        'event_name' => 'required|string|max:255',
        'status' => 'required|in:draft,published,revoked',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        'recipient' => 'required|string|max:255',
        'selected_template_id' => 'required|exists:templates,id',
    ]);
     
    // Generate UID and verification code
    $uid = Str::uuid();
    $verificationCode = strtoupper(Str::random(10));

    // Simpan ke tabel contacts
    $contact = new Contact();
    $contact->name = $request->recipient;
    $contact->email = Str::slug($request->recipient) . '-' . Str::random(5) . '@example.com';
    $contact->save();

    // Upload logo jika ada
    $logoPath = null;
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    // Upload tanda tangan jika ada
    $signaturePath = null;
    if ($request->hasFile('signatureImage')) {
        $signaturePath = $request->file('signatureImage')->store('signatures', 'public');
    }

    // Simpan ke tabel certificates
    $certificate = new Certificate();
    $certificate->selected_template_id = $request->selected_template_id;
    $certificate->contact_id = $contact->id;
    $certificate->uid = $uid;
    $certificate->verification_code = $verificationCode;
    $certificate->event_name = $request->event_name;
    $certificate->logo_path = $logoPath;
    $certificate->signature_path = $signaturePath;
    $certificate->signature_name = $request->signature_name;
    $certificate->title = $request->title;
    $certificate->role = $request->role;
    $certificate->certificate_type = $request->certificate_type;
    $certificate->date = $request->date;
    $certificate->description = $request->description;
    $certificate->status = $request->status;
    $certificate->save();

    return redirect()->route('templateadmin.previews', ['id' => $certificate->id])
        ->with('success', 'Sertifikat berhasil disimpan!');
}

public function sendEmail(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'image' => 'required|string', // base64
    ]);

    // Simpan image ke file sementara
    $image = $request->image;
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = 'certificate_' . Str::slug($request->name) . '.png';
    $imagePath = storage_path("app/public/{$imageName}");
    file_put_contents($imagePath, base64_decode($image));

    // Kirim email
    Mail::to($request->email)->send(new CertificateMail($request->name, $imageName));

    return response()->json(['message' => 'Certificate sent to ' . $request->email]);
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
        // Cek apakah $id diterima dengan benar
    dd($id); // Pastikan parameter id diterima

    $background = 'upload/backgrounds/yellow-gradient.jpg';
    $contacts = DB::table('contact')->get();

    return view('templateadmin.preview', compact('background', 'contacts'));
    }

    public function download($id)
    {
        $certificate = Certificate::with('template')->findOrFail($id);
        $pdf = \PDF::loadView('templateadmin.pdf', compact('certificate'));
        return $pdf->download("templateadmin-{$certificate->uid}.pdf");
    }
    // Menampilkan halaman upload background
    public function upload()
    {
        return view('layout.upload');
    }

    // Menyimpan file background yang di-upload ke database dan direktori sementara
    public function storeUpload(Request $request)
    {
        $request->validate([
            'background' => 'required|image|mimes:jpg,jpeg,png,svg|max:5120',
        ]);
    
        try {
            $file = $request->file('background');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $destinationPath = public_path('storage/templates');
            $file->move($destinationPath, $filename);
    
            $relativePath = 'storage/templates/' . $filename;
    
            // Simpan ke database
            $template = new Template();
            $template->user_id = Auth::id(); // atau default jika belum login
            $template->name = 'Template ' . now()->format('Y-m-d H:i:s');
            $template->background_image_url = $relativePath;
            $template->file_path = $relativePath;
            $template->save();
    
            // Simpan ke session
            session([
                'background' => asset($relativePath),
                'template_id' => $template->id,
            ]);
    
            return redirect()->route('templateadmin.dataInput')
                             ->with('success', 'Background berhasil diupload.');
        } catch (\Exception $e) {
            return back()->withErrors(['upload' => 'Terjadi kesalahan saat mengupload: ' . $e->getMessage()]);
        }
    }

     // Menampilkan halaman untuk input data setelah upload
     public function dataInput()
     {
        $template = new Template(); // Atau null jika kamu ingin kosong
        return view('layout.data_input', compact('template'));
     }

     // Menyimpan data input ke database
    public function storeData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'recipient' => 'required|string|max:255',
            'date' => 'required|date',
            'layout_storage' => 'nullable|json',
        ]);
    
        $template = new Template();
        $template->user_id = Auth::id(); // ← WAJIB ditambah
        $template->name = $request->input('name');
        $template->recipient = $request->input('recipient');
        $template->date = $request->input('date');
        $template->background_image_url = session('background');
        $template->layout_storage = $request->input('layout_storage');
        $template->save();
       // $path = $file->store('backgrounds', 'public');
       // session(['background' => Storage::url($path)]);
        session()->forget('background');
        return redirect()->route('templateadmin.dataInput')->with('success', 'Template saved successfully!');
    }

    // Menghapus background sementara dari penyimpanan dan database
    public function deleteTemporaryBackground($id)
    {
        $background = CertificateBackground::findOrFail($id);

        // Menghapus file dari penyimpanan
        Storage::delete($background->file_path);

        // Menghapus data dari database
        $background->delete();

        return redirect()->route('templateadmin.upload')->with('success', 'Background deleted successfully.');
    }
    public function selectTemplate($id)
{
    session(['templateId' => $id]);
    return redirect()->route('templateadmin.contacts');
}

    public function showRecipientPage($id)
    {
        // Ambil data template dari database (opsional kalau butuh datanya, bukan cuma ID)
        $template = Template::findOrFail($id);
        $templateId = 1;

        // Kirim ke view, cukup ID-nya saja
        return view('layout.recipient', ['templateId' => $template->id]);
    }
    public function showRecipient()
{
    $contacts = Contact::all(); // Ambil semua kontak dari database
    return view('layout.recipienttemplate', compact('contacts'));
}     

}
?>