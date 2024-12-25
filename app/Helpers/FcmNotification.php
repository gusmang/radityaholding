<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kutia\Larafirebase\Facades\Larafirebase;

class FcmNotification
{

    public function send($title, $body, array $token, $app = 'Balicash', $data = null)
    {
        if ($app == 'Balicash') {
            $logo = asset('img/icon-balicashagent.png');
        } else {
            $logo = asset('img/favicon.png');
        }

        return Larafirebase::withTitle($title)
            ->withBody($body)
            // ->withImage('https://firebase.google.com/images/social.png')
            ->withIcon($logo)
            ->withSound('default')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
                'data' => $data
            ])
            ->sendNotification($token);
    }

    public function sendUserId($user_id, $title, $message)
    {
        $tokens = DB::table('fcm_tokens')->where('user_id', $user_id)->select('token')->pluck('token')->toArray();
        return $this->send($title, $message, $tokens, "Yespos");
    }
}
