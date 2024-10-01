<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'data' => 'required|array',
        ]);

        // Store notification in the database
        Notification::create([
            'type' => $request->type,
            'data' => json_encode($request->data),
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    public function getUnreadNotifications()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->where('read', false)
            ->latest()
            ->get();

        return response()->json($notifications);
    }
}
