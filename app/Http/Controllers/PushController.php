<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;


class PushController extends Controller
{
    public function sendNotification(Request $request)
    {
        $OneSignal = new OneSignal();
        $notification = OneSignal::factory()
            ->setContents(['en' => $request->message]) // Customize message based on locale
            ->setHeading($request->title) // Add notification heading
            ->setIncludePlayers(null); // Send to all players

        $response = $OneSignal->sendNotification($notification);

        if ($response->getStatusCode() === 200) {
            return response()->json(['success' => true, 'message' => 'Notification sent!']);
        } else {
            return response()->json(['success' => false, 'message' => $response->getBody()->getContents()]);
        }
    }
}
