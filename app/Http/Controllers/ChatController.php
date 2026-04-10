<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $admin = User::where('is_admin', 1)->firstOrFail();
        $currentUserId = auth()->id();
        $messages = Message::with(['sender', 'receiver'])
            ->where(function ($query) use ($currentUserId, $admin) {
                $query->where(function ($q) use ($currentUserId, $admin) {
                    $q->where('sender_id', $currentUserId)
                      ->where('receiver_id', $admin->id);
                })->orWhere(function ($q) use ($currentUserId, $admin) {
                    $q->where('sender_id', $admin->id)
                      ->where('receiver_id', $currentUserId);
                });
            })
            ->latest()
            ->get();

        return view('user.chat.main', compact('messages', 'admin'));
    }

    public function adminIndex()
    {
        $admins = User::where('is_admin', 1)->get();
        $users = User::where('is_admin', 0)->get();

        $selectedUserId = request('user_id');
        $messages = Message::with(['sender', 'receiver'])
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('sender_id', $selectedUserId)
                      ->orWhere('receiver_id', $selectedUserId);
            })
            ->latest()
            ->get();

        return view('admin.chat.main', compact('messages', 'users', 'admins', 'selectedUserId'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent!');
    }
}

