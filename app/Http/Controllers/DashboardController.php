<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('dashboard.pages.dashboard.index');
    }

    public function sendNotification()
    {
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withSound('default')
            ->withClickAction('https://www.google.com')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
            ])
            ->sendNotification($this->deviceTokens);
        
        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($this->deviceTokens);
    }

    public function sendMessage(Request $request)
    {
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->sendMessage($request->token);
            
        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendMessage($this->deviceTokens);
    }

    public function logout(Request $request){
        \Auth::logout();
    
        // Optional: Invalidate session to ensure it’s cleared completely.
        $request->session()->invalidate();

        // Optional: Regenerate session token to prevent session fixation.
        $request->session()->regenerateToken();

        // Redirect the user to the login page or another page.
        return redirect('/login');
    }
}
