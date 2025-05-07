<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());})->with(['sender', 'receiver'])->get()
            ->map(function ($message) {
                return $message->sender_id == Auth::id() ? $message->receiver : $message->sender;
            })
            ->unique('acc_id')
            ->values();
        return view('website.chat.chat', compact('users'));
    }

    public function show($userId)
    {
        Message::where('receiver_id', Auth::id())->where('sender_id', $userId)->where('is_read', 0)->update(['is_read' => 1]);
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId)->where('receiver_id', Auth::id());})
            ->with(['sender', 'receiver'])
            ->orderBy('ma_date_time', 'asc')
            ->get();
        $users = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());})->with(['sender', 'receiver'])->get()
            ->map(function ($message) {
                return $message->sender_id == Auth::id() ? $message->receiver : $message->sender;
            })
            ->unique('acc_id')
            ->values();
        $chatUser = \App\Models\Account::findOrFail($userId);

        return view('website.chat.chat', compact('messages', 'chatUser', 'users'));
    }

    public function send(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'ma_content' => $request->message,
            'ma_date_time' => now(),
            'is_read' => 0,
        ]);
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
