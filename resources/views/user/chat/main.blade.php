@extends('layouts.navbar')
@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Chat with Admin</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
        <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
            @forelse ($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                        <p>{{ $message->message }}</p>
                        <p class="text-xs opacity-75 mt-1">{{ $message->sender->name }} • {{ $message->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No messages yet. Start the conversation!</p>
            @endforelse
        </div>

        <form action="{{ url('/dashboard/chat') }}" method="POST" class="flex gap-2">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $admin->id ?? 1 }}">
            <input type="text" name="message" placeholder="Type your message..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Send</button>
        </form>
    </div>
</div>
@endsection

