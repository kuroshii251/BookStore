@extends('layouts.navbaradmin')
@section('content')

@php
    $avatarColors = [
        'bg-amber-100 text-amber-800',
        'bg-rose-100 text-rose-800',
        'bg-teal-100 text-teal-800',
        'bg-violet-100 text-violet-800',
        'bg-sky-100 text-sky-800',
    ];
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500&display=swap');
    .serif { font-family: 'Playfair Display', serif; }
    body   { font-family: 'DM Sans', sans-serif; }
    #chat-box::-webkit-scrollbar       { width: 4px; }
    #chat-box::-webkit-scrollbar-thumb { background: #e2d4c4; border-radius: 4px; }
    #user-list::-webkit-scrollbar       { width: 4px; }
    #user-list::-webkit-scrollbar-thumb { background: #e2d4c4; border-radius: 4px; }
</style>

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <p class="text-xs tracking-widest uppercase text-amber-700 font-medium mb-1">Admin Panel</p>
        <h1 class="serif text-3xl font-bold text-stone-800">Chat Dashboard</h1>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4" style="height: calc(100vh - 220px); min-height: 500px;">

        {{-- ── User List ── --}}
        <div class="bg-white border border-stone-100 rounded-2xl shadow-sm flex flex-col overflow-hidden">
            <div class="px-5 py-4 border-b border-stone-100">
                <h2 class="serif text-base font-semibold text-stone-800">Pembeli</h2>
                <p class="text-xs text-stone-400 mt-0.5">{{ $users->count() }} pengguna terdaftar</p>
            </div>

            <div id="user-list" class="flex-1 overflow-y-auto p-2">
                @forelse ($users as $i => $user)
                    @php $color = $avatarColors[$i % count($avatarColors)]; @endphp
                    <a href="?user_id={{ $user->id }}"
                       class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors duration-150 group
                              {{ request('user_id') == $user->id
                                    ? 'bg-amber-50 border border-amber-200'
                                    : 'hover:bg-stone-50 border border-transparent' }}">

                        {{-- Avatar --}}
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0 {{ $color }}">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-stone-800 truncate
                               {{ request('user_id') == $user->id ? 'text-amber-800' : '' }}">
                                {{ $user->name }}
                            </p>
                            <p class="text-xs text-stone-400 truncate">{{ $user->email }}</p>
                        </div>

                        @if(request('user_id') == $user->id)
                            <div class="w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></div>
                        @endif
                    </a>
                @empty
                    <div class="text-center py-10">
                        <p class="text-3xl mb-2">👤</p>
                        <p class="text-sm text-stone-400">Belum ada pengguna.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ── Chat Panel ── --}}
        <div class="lg:col-span-2 bg-white border border-stone-100 rounded-2xl shadow-sm flex flex-col overflow-hidden">

            {{-- Chat header --}}
            <div class="px-6 py-4 border-b border-stone-100 flex items-center gap-3">
                @if ($selectedUser)
                    @php
                        $idx   = $users->search(fn($u) => $u->id == $selectedUser->id);
                        $color = $avatarColors[$idx % count($avatarColors)];
                    @endphp
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold {{ $color }}">
                        {{ strtoupper(substr($selectedUser->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-stone-800">{{ $selectedUser->name }}</p>
                        <p class="text-xs text-stone-400">{{ $selectedUser->email }}</p>
                    </div>
                @else
                    <div class="w-9 h-9 rounded-full bg-stone-100 flex items-center justify-center text-stone-300 text-lg">
                        💬
                    </div>
                    <p class="text-sm text-stone-400">Pilih pengguna untuk memulai chat</p>
                @endif
            </div>

            {{-- Messages --}}
            <div id="chat-box" class="flex-1 overflow-y-auto px-6 py-4 space-y-3 bg-stone-50">
                @if (!$selectedUserId)
                    <div class="flex flex-col items-center justify-center h-full text-center py-16">
                        <p class="text-5xl mb-4">📚</p>
                        <p class="text-stone-400 text-sm">Pilih pengguna di sebelah kiri<br>untuk melihat percakapan.</p>
                    </div>
                @else
                    @forelse ($messages as $message)
                        @php $isAdmin = $message->sender_id == auth()->id(); @endphp
                        <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-sm">
                                <div class="px-4 py-2.5 rounded-2xl text-sm
                                    {{ $isAdmin
                                        ? 'bg-amber-700 text-white rounded-br-sm'
                                        : 'bg-white border border-stone-200 text-stone-800 rounded-bl-sm shadow-sm' }}">
                                    <p>{{ $message->message }}</p>
                                </div>
                                <p class="text-xs text-stone-400 mt-1 {{ $isAdmin ? 'text-right' : 'text-left' }}">
                                    {{ $message->sender->name }} · {{ $message->created_at->format('d M, H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-center py-16">
                            <p class="text-4xl mb-3">✉️</p>
                            <p class="text-stone-400 text-sm">Belum ada pesan dengan pengguna ini.</p>
                        </div>
                    @endforelse
                @endif
            </div>

            {{-- Send form --}}
            <div class="px-6 py-4 border-t border-stone-100 bg-white">
                @if ($selectedUser)
                    <form action="{{ url('/admindashboard/chat') }}" method="POST" class="flex gap-3">
                        @csrf
                        {{-- Auto-fill receiver dari user yang dipilih --}}
                        <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">
                        <input type="text" name="message"
                               placeholder="Tulis pesan ke {{ $selectedUser->name }}…"
                               class="flex-1 px-4 py-2.5 text-sm bg-stone-50 border border-stone-200 rounded-xl
                                      focus:outline-none focus:ring-2 focus:ring-amber-300 focus:border-amber-400
                                      transition-all duration-150"
                               required autocomplete="off">
                        <button type="submit"
                                class="px-5 py-2.5 bg-amber-700 text-white text-sm font-medium rounded-xl
                                       hover:bg-amber-800 transition-colors duration-150 flex items-center gap-2 flex-shrink-0">
                            Kirim
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2L15 22l-4-9-9-4 19-7z"/>
                            </svg>
                        </button>
                    </form>
                @else
                    <div class="flex items-center gap-3 px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl">
                        <p class="text-sm text-stone-400 flex-1">Pilih pengguna untuk membalas pesan...</p>
                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2L15 22l-4-9-9-4 19-7z"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- Auto-scroll ke pesan terbaru --}}
<script>
    const chatBox = document.getElementById('chat-box');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>

@endsection
