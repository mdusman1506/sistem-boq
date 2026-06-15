<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getUnread()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['count' => 0, 'notifications' => []]);
        }

        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'title' => $notif->title,
                    'message' => $notif->message,
                    'link' => $notif->link ? url($notif->link) : null,
                    'created_at' => $notif->created_at->diffForHumans()
                ];
            });

        return response()->json([
            'count' => Notification::where('user_id', $user->id)->where('is_read', false)->count(),
            'notifications' => $notifications
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        if ($notification->link) {
            return redirect($notification->link);
        }

        return back();
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}
