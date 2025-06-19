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
        $query = User::query();

        // Filter berdasarkan role
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
        $roles = ['superadmin', 'admin', 'recipient', 'guest'];
        $totalUser = User::count();
        $totalAdmin = User::whereIn('role', ['superadmin', 'admin'])->count(); // lebih tepat pakai whereIn
        $totalActiveUser = User::where('status', 'active')->count();

        return view('user.index', compact('users', 'totalUser', 'totalAdmin', 'totalActiveUser', 'roles'));
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

    // user create untuk admin
    public function UserCreate()
    {
        $roles = ['superadmin', 'admin', 'recipient', 'guest'];
        return view('user.index', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:superadmin,admin,recipient,guest,',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.index');
    }

    // end

    // edit untuk user admin
    public function AdminEdit($id)
    {
        $user = User::findOrFail($id);
        $roles = ['guest', 'admin', 'superadmin'];
        $users = User::all();
        $totalUser = $users->count();
        $totalActiveUser = User::where('status', 'active')->count();
        $totalAdmin = User::where('role', ['superadmin', 'admin', 'recipient', 'guest'])->count();

        return view('user.index', compact('user', 'roles', 'users', 'totalUser', 'totalActiveUser', 'totalAdmin'));
    }

    public function Adminupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi inputan
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role' => 'required|in:guest,admin,superadmin',
            'status' => 'required|in:active,inactive',
        ]);

        // Update data user
        $user->username = $request->input('username');
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('admin.user.edit', $user->id);
    }
    // end

    // delete untuk admin
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
    // end

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