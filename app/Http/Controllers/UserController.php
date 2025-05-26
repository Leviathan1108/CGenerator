<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // total user dan menampilkan user
    public function index(Request $request)
    {
        // query builder untuk user
        $query = User::query();

        // Filter berdasarkan role user
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data user berdasarkan filter
        $users = $query->get();

        // Statistik
        $totalUser = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalActiveUser = User::where('status', 'active')->count();

        return view('user.index', compact('users', 'totalUser', 'totalAdmin', 'totalActiveUser'));
    }

    // function untuk active and inactive
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'User activated successfully.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';
        $user->save();

        return redirect()->back()->with('success', 'User deactivated successfully.');
    }
    //end

    // Form edit profile
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('settings', compact('user'));
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

        return redirect()->route('settings', $user->id)->with('success', 'Profil berhasil diperbarui.');
    }

}
