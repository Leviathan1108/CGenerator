<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    // Tampilkan daftar template
    public function index()
    {
        $templates = Template::all();
        return view('templatesuperadmin.index', compact('templates'));
    }

    // Tampilkan form tambah template
    public function create()
    {
        $templates = Template::all();
        return view('templatesuperadmin.index', compact('templates'));
    }

    // Simpan template baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
        ]);

        $filePath = $request->file('file')->store('templates', 'public');

        Template::create([
            'user_id' => Auth::id(),// otomatis isi dari user yang login
            'name' => $request->name,
            'date' => Carbon::now()->toDateString(), // otomatis isi tanggal hari ini (format: YYYY-MM-DD)
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $filePath,
        ]);

        return redirect()->route('templatesuperadmin.index')->with('success', 'Template berhasil ditambahkan!');
    }

    // Edit template
    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return view('templatesuperadmin.index', compact('template'));
    }

    // Update template
    public function update(Request $request, Template $templatesuperadmin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('templates', 'public');
            $templatesuperadmin->file_path = $filePath;
        }
    
        $templatesuperadmin->name = $request->name;
        $templatesuperadmin->description = $request->description;
        $templatesuperadmin->type = $request->type;
    
        if (is_null($templatesuperadmin->user_id)) {
            $templatesuperadmin->user_id = Auth::id();
        }
    
        $templatesuperadmin->save();        
    
        return redirect()->route('templatesuperadmin.index')->with('success', 'Template berhasil diperbarui!');
    }
    

    // Hapus template
    public function destroy(Template $templatesuperadmin)
    {
        $templatesuperadmin->delete();
        return redirect()->route('templatesuperadmin.index')->with('success', 'Template berhasil dihapus!');
    }
    
    

    // Tampilkan UI pilih template seperti di desain
        public function select()
    {
        $templates = Template::all();
        return view('templatesuperadmin.select', compact('templates'));
    }

}
?>