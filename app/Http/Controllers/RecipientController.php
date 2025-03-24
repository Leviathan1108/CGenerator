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
}
