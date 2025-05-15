<?php


namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all(); // Ambil semua data kontak
        $templateId = session('templateId');
    return view('layout.recipient', compact('contacts', 'templateId')); // Kirim data ke tampilan Blade 'contacts.index'

    }
    // Store contact baru
    public function store(Request $request)
{
    try {
        \Log::info('Incoming contact store request', $request->all());

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $contact = new Contact();
        $contact->name = $validated['name'];
        $contact->email = $validated['email'];
        $contact->save();

        return response()->json($contact);
    } catch (\Exception $e) {
        \Log::error('Contact Store Error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    // Update contact
    public function update(Request $request, Contact $contact)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    // Update the contact in the database
    $contact->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    // Return the updated contact data to the client
    return response()->json($contact);
}


    // Hapus contact
    public function destroy(Contact $contact)
    {
        $contact->delete();
    return response()->json(null, 204); // Successfully deleted
    }
    public function selectTemplate($id)
{
    session(['templateId' => $id]);
    return redirect()->route('templateadmin.contacts');
}
}
