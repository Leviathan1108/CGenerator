<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan file register.blade.php ada di folder resources/views/auth
    }

    /**
     * Proses registrasi user baru
     */
    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',  // Menggunakan 'string', bukan 'varchar'
            'email' => 'required|string|email|max:255|unique:users', 
            'username' => 'required|string|max:255|unique:users', 
            'password' => 'required|string|min:6|confirmed', 
        ]);

        // Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

         // Debugging: Cek apakah user langsung login atau tidak
    dd(Auth::check()); // Harusnya FALSE jika tidak login otomatis

        // Redirect ke halaman login dengan alert sukses
        return redirect()->route('login')->with('success', 'Berhasil Menambahkan Akun, Silahkan Login');
    }
}
