<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layout;

class LayoutController extends Controller
{
    /**
     * Simpan layout berdasarkan template_id.
     * Endpoint: POST /certificate/layout
     */
    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|integer',
            'layout' => 'required|array' // layout dikirim sebagai object (array)
        ]);

        $layoutJson = json_encode($request->layout); // encode ke JSON string untuk disimpan

        Layout::updateOrCreate(
            ['template_id' => $request->template_id],
            ['layout' => $layoutJson]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Ambil layout berdasarkan template_id.
     * Endpoint: GET /certificate/layout?template_id=1
     */
    public function show(Request $request)
    {
        $request->validate([
            'template_id' => 'required|integer'
        ]);

        $layout = Layout::where('template_id', $request->template_id)->first();

        if (!$layout) {
            return response()->json(['error' => 'Layout tidak ditemukan'], 404);
        }

        return response()->json([
            'layout' => json_decode($layout->layout) // kirim sebagai object (array)
        ]);
    }
}
