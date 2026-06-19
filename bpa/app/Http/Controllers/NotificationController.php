<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->get();
        return view('notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back();
    }
}
