<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        // Validasi input
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png,docx|max:2048',
            'email' => 'required|email'
        ]);

        // Ambil file yang diupload
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename);

            // Kirim email ke pengguna
            Mail::send([], [], function ($message) use ($request, $path, $filename) {
                $message->to($request->email)
                        ->subject('File Anda Telah Diupload')
                        ->attach(storage_path('app/' . $path), [
                            'as' => $filename,
                            'mime' => mime_content_type(storage_path('app/' . $path)),
                        ])
                        ->setBody('Terima kasih telah mengupload file Anda. Berikut adalah file yang Anda kirimkan.');
            });

            return back()->with('success', 'File berhasil diupload dan dikirim ke email Anda!');
        }

        return back()->with('error', 'File yang diupload tidak valid.');
    }

    public function downloadFile($filename)
    {
        $filePath = 'uploads/' . $filename;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
