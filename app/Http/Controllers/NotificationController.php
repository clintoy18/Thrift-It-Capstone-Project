<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get unread notifications for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->getRecentUnreadNotifications(10);
        $unreadCount = $user->unread_notifications_count;

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'unread_count' => $user->unread_notifications_count
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'unread_count' => 0
        ]);
    }

    /**
     * Get unread notifications count only
     */
    public function count()
    {
        $user = Auth::user();
        
        return response()->json([
            'unread_count' => $user->unread_notifications_count
        ]);
    }
}
