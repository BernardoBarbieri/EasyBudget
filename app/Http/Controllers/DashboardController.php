<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(){
        $user = Auth::user();
        $events = $user ? $user->events()->count() : 0;
        return view('dashboard', compact('events'));
    }
}
