<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

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
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
        ]);

        $filePath = $request->file('file')->store('templates', 'public');

        Template::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'template_data' => $filePath,
        ]);

        return redirect()->route('templates.index')->with('success', 'Template berhasil ditambahkan!');
    }

    // Edit template
    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return view('templates.edit', compact('template'));
    }

    // Update template
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('templates', 'public');
            $template->template_data = $filePath;
        }

        $template->name = $request->name;
        $template->save();

        return redirect()->route('templates.index')->with('success', 'Template berhasil diperbarui!');
    }

    // Hapus template
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('templates.index')->with('success', 'Template berhasil dihapus');
    }
}
