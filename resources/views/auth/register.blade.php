<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10 font-sans">

    <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl p-10 shadow-sm">

        {{-- Icon --}}
        <div class="flex justify-center mb-5">
            <div class="w-11 h-11 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
            </div>
        </div>

        {{-- Header --}}
        <div class="text-center mb-7">
            <h1 class="text-xl font-medium text-gray-900">Buat akun baru</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar dan mulai gunakan layanan kami</p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('registers') }}" method="POST" novalidate>
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-xs font-medium text-gray-500 mb-1.5">Nama lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </span>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-gray-400 transition"
                    >
                </div>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-gray-400 transition"
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Buat password"
                        oninput="checkStrength(this.value)"
                        class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-gray-400 transition"
                    >
                </div>
                {{-- Strength Bar --}}
                <div class="flex gap-1 mt-2" id="strength-bar">
                    <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all" id="s1"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all" id="s2"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all" id="s3"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all" id="s4"></div>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label for="confirm_password" class="block text-xs font-medium text-gray-500 mb-1.5">Konfirmasi password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Ulangi password"
                        class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-gray-400 transition"
                    >
                </div>
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium py-2.5 rounded-lg transition duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
                Daftar sekarang
            </button>

            {{-- Terms --}}
            <p class="text-xs text-gray-400 text-center mt-3 leading-relaxed">
                Dengan mendaftar, kamu menyetujui
                <a href="#" class="text-gray-500 underline underline-offset-2">Syarat & Ketentuan</a>
                serta
                <a href="#" class="text-gray-500 underline underline-offset-2">Kebijakan Privasi</a> kami.
            </p>
        </form>

        <div class="flex items-center gap-3 my-5">
            <hr class="flex-1 border-gray-200">
            <span class="text-xs text-gray-400">sudah punya akun?</span>
            <hr class="flex-1 border-gray-200">
        </div>

        <div class="text-center">
            <a href="/login" class="text-sm text-gray-800 underline underline-offset-2 hover:text-gray-600 transition">
                Masuk ke akun saya →
            </a>
        </div>

    </div>

    <script>
        function checkStrength(val) {
            const segs = ['s1', 's2', 's3', 's4'].map(id => document.getElementById(id));
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const colors = {
                1: '#ef4444',
                2: '#f97316',
                3: '#22c55e',
                4: '#16a34a'
            };

            segs.forEach((s, i) => {
                s.style.background = i < score ? colors[score] : '#e5e7eb';
            });
        }
    </script>

</body>
</html>