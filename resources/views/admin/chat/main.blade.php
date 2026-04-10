@extends('layouts.navbaradmin')
@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Chat Dashboard</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Users</h2>
            <div class="space-y-2 max-h-96 overflow-y-auto">
                @foreach ($users as $user)
                    <a href="?user_id={{ $user->id }}" class="flex items-center p-3 hover:bg-gray-100 rounded-lg {{ request('user_id') == $user->id ? 'bg-blue-100 border-2 border-blue-500' : '' }} transition">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6">
            <div class="h-96 overflow-y-auto mb-6 space-y-4">
                @forelse ($messages as $message)
                    <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : '' }}">
                        <div class="max-w-md px-4 py-2 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                            <p>{{ $message->message }}</p>
                            <p class="text-xs opacity-75 mt-1">{{ $message->sender->name }} → {{ $message->receiver->name }}</p>
                            <p class="text-xs opacity-75">{{ $message->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-12">No messages yet</p>
                @endforelse
            </div>

            <form action="{{ url('/admindashboard/chat') }}" method="POST" class="flex gap-2">
                @csrf
                <select name="receiver_id" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="message" placeholder="Type message..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection

