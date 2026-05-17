<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Reset Password</h1>
            <p class="text-gray-500 mt-1">Masukkan email untuk menerima link reset</p>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-800 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-800 text-sm">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition"
                    placeholder="Masukkan email" required>
            </div>

            <button type="submit"
                class="w-full bg-black text-white py-2 rounded-lg font-semibold hover:bg-gray-800 transition duration-200">
                Kirim Link Reset
            </button>

            <p class="text-sm mt-4 text-center text-gray-600">
                Sudah ingat password?
                <a href="/login" class="text-blue-600 hover:underline">Login</a>
            </p>
        </form>
    </div>

</body>

</html>

