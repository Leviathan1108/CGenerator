<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CertificateBackground;
use Illuminate\Support\Facades\Storage;
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
    

    public function store(Request $request)
    {
        $request->validate([
    'event_name' => 'required|string|max:255',
    'background_choice' => 'required|in:custom,template',
    'status' => 'required|in:draft,published,revoked',
    'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
    'participant_name' => 'required|string|max:255',
]);

if ($request->background_choice === 'template') {
    $request->validate([
        'selected_template_id' => 'required|exists:templates,id',
    ]);
}

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
        // Retrieve the certificate by id with associated template and user
    $certificate = Certificate::with('template', 'user')->findOrFail($id);

    // Prepare the data to be passed to the view
    $data = [
        'name' => $certificate->user->name,
        'event' => $certificate->event_name,
    ];

    // Return the view and pass the necessary data
    return view('templateadmin.preview', [
        'data' => $data,
        'logo' => $certificate->template->logo_path ?? null,
        'background' => $certificate->template->background_choice ?? null, // Default background if available
        'templateId' => $certificate->template->id, // If you need to pass the template ID to use for the background
    ]);
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

        $file = $request->file('background');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/backgrounds'), $filename);

        // Simpan URL gambar di session untuk digunakan pada halaman berikutnya
        session(['background' => asset('uploads/backgrounds/' . $filename)]);

        return redirect()->route('templateadmin.dataInput');
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

    public function template()
    {
        $templates = Template::all();
        return view('layout.template', compact('templates'));
    }              
}
?>