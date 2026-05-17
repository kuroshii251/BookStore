<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showww(){
        return view('user.chat.main');
    }

public function index()
{
    $admin = User::where('is_admin', 1)->first();

    if (!$admin) {
        return view('user.chat.main', [
            'messages' => collect(),
            'admin'    => null,
        ]);
    }

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
        ->oldest()  
        ->get();

    return view('user.chat.main', compact('messages', 'admin'));
}

public function adminIndex()
{
    $admin = auth()->user();

    if (!$admin || !$admin->is_admin) {
        abort(403);
    }

    $users = User::where('is_admin', 0)->get();
    $selectedUserId = request('user_id');
    $selectedUser = null;
    $messages = collect();

    if ($selectedUserId) {
        $selectedUser = User::find($selectedUserId);

        if ($selectedUser) {
            $messages = Message::with(['sender', 'receiver'])
                ->where(function ($q) use ($admin, $selectedUserId) {
                    $q->where('sender_id', $admin->id)
                        ->where('receiver_id', $selectedUserId);
                })
                ->orWhere(function ($q) use ($admin, $selectedUserId) {
                    $q->where('sender_id', $selectedUserId)
                        ->where('receiver_id', $admin->id);
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    return view('admin.chat.main', compact('messages', 'users', 'selectedUserId', 'selectedUser'));
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

    // Balik ke halaman chat admin agar UI tidak blank
    return redirect()->to('/admindashboard/chat' . (request('receiver_id') ? '?user_id=' . request('receiver_id') : ''))
        ->with('success', 'Message sent!');
}
}

