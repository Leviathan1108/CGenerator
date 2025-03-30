<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipient::all();
        return view('recipients.index', compact('recipients'));
    }

    public function create()
    {
        return view('recipients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:recipients,email',
        ]);

        Recipient::create($request->all());

        return redirect()->route('recipients.index')->with('success', 'Recipient created successfully.');
    }

    public function edit(Recipient $recipient)
    {
        return view('recipients.edit', compact('recipient'));
    }

    public function update(Request $request, Recipient $recipient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:recipients,email,' . $recipient->recipient_id . ',recipient_id',
        ]);
    
        $recipient->update($request->all());
    
        return redirect()->route('recipients.index')->with('success', 'Recipient updated successfully.');
    }
    

    public function destroy(Recipient $recipient)
    {
        $recipient->delete();
        return redirect()->route('recipients.index')->with('success', 'Recipient deleted successfully.');
    }

}

?>