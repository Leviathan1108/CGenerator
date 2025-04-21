<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Tampilkan profile user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.index', compact('user'));
    }

    // Form edit profile
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Simpan perubahan profile

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user->username = $request->username;

        if ($request->hasFile('photo_profile')) {
            $filePath = $request->file('photo_profile')->store('users', 'public');
            $user->photo_profile = $filePath;
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Profil berhasil diperbarui.');
    }

}
