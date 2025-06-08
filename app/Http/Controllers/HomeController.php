<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Template;

class HomeController extends Controller
{
   public function index()
    {
        $totalSent = Certificate::count();
        $totalTemplate = Template::count();
        $totalCertificate = $totalSent + $totalTemplate;
        return view('home', compact('totalTemplate', 'totalSent', 'totalCertificate'));
    }
    public function dashboard()
{
    return view('home');
}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
 //   {
//        $this->middleware('auth');
 //   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


}
?>