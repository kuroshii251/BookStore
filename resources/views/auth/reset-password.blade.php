<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password – BookPedia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .serif { font-family: 'Playfair Display', serif; }
        .input-field {
            width: 100%;
            padding: 0.65rem 1rem 0.65rem 2.75rem;
            border: 1.5px solid #e7e5e4;
            border-radius: 12px;
            font-size: 0.875rem;
            background: #faf9f7;
            color: #1c1917;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s;
            font-family: 'DM Sans', sans-serif;
        }
        .input-field:focus {
            border-color: #b45309;
            box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.1);
            background: #fff;
        }
        .input-field::placeholder { color: #b0a99e; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color:#f5efe6;">

    {{-- Decorative background dots --}}
    <div class="fixed inset-0 pointer-events-none" style="background-image:radial-gradient(#d4b896 1px,transparent 1px);background-size:28px 28px;opacity:0.35;"></div>

    <div class="relative w-full max-w-md mx-4">

        {{-- Brand --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 no-underline">
                <span class="w-10 h-10 rounded-xl bg-amber-700 flex items-center justify-center text-xl">📚</span>
                <span class="serif text-2xl font-bold text-stone-800">BookPedia</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">

            {{-- Header --}}
            <div class="text-center mb-7">
                <div class="w-14 h-14 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-2xl mx-auto mb-4">
                    🔑
                </div>
                <h1 class="serif text-2xl font-bold text-stone-800">Buat Password Baru</h1>
                <p class="text-stone-500 text-sm mt-1.5">Masukkan password baru untuk akun kamu</p>
            </div>

            {{-- Alerts --}}
            @if (session('status'))
                <div class="mb-5 flex items-start gap-3 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-800 text-sm">
                    <span class="mt-0.5">✅</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-800 text-sm">
                    <span class="mt-0.5">⚠️</span>
                    <span>{{ $errors->first('password') ?? $errors->first('email') ?? $errors->first() }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                {{-- Email dari query string link reset --}}
                <input type="hidden" name="email" value="{{ request()->email ?? old('email') }}">

                {{-- Password baru --}}
                <div>
                    <label for="password" class="block text-xs font-medium text-stone-600 uppercase tracking-wider mb-1.5">
                        Password Baru
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password" name="password" id="password"
                               class="input-field"
                               placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    </div>
                </div>

                {{-- Konfirmasi password --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-stone-600 uppercase tracking-wider mb-1.5">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="input-field"
                               placeholder="Ulangi password baru" required autocomplete="new-password">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-xl font-semibold text-sm transition-colors duration-200 mt-2">
                    Simpan Password Baru
                </button>
            </form>

            {{-- Back to login --}}
            <p class="text-center text-sm text-stone-500 mt-6">
                Ingat password?
                <a href="/login" class="text-amber-700 font-medium hover:text-amber-900 transition-colors">Masuk sekarang</a>
            </p>

        </div>

        <p class="text-center text-xs text-stone-400 mt-6">© 2025 BookPedia. Hak cipta dilindungi.</p>
    </div>

</body>
</html>