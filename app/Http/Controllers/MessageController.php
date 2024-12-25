<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = "Tes Bos";
        event(new MessageSent($message));
        return response()->json(['status' => 'Message sent!']);
    }
}