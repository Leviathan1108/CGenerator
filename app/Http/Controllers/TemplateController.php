<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class TemplateController extends Controller
{
    // Tampilkan daftar template
    public function index()
    {
        $templates = Template::all();
        return view('templates.index', compact('templates'));
    }

    // Tampilkan form tambah template
    public function create()
    {
        return view('templates.create');
    }

    // Simpan template baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
            'layout_storage' => 'required|string|max:255',
        ]);
    
        $filePath = $request->file('file')->store('templates', 'public');
    
        Template::create([
            'name' => $request->name,
            'file_path' => $filePath,
            'layout_storage' => $request->layout_storage,
        ]);
    
        return redirect()->route('templates.index')->with('success', 'Template berhasil ditambahkan!');
    }
    
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
            'layout_storage' => 'required|string|max:255',
        ]);
    
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('templates', 'public');
            $template->file_path = $filePath;
        }
    
        $template->name = $request->name;
        $template->layout_storage = $request->layout_storage;
        $template->save();
    
        return redirect()->route('templates.index')->with('success', 'Template berhasil diperbarui!');
    }
    

    // Hapus template
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('templates.index')->with('success', 'Template berhasil dihapus');
    }

    public function edit($id)
{
    $template = Template::findOrFail($id);
    return view('layout.nc', compact('template')); 
}

}

?>