<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Example: Fetch the latest notifications for the authenticated user
        $notifications = auth()->user()->notifications()->latest()->get();

        return response()->json([
            'unreadCount' => auth()->user()->unreadNotifications->count(),
            'notifications' => $notifications,
        ]);
    }
}
