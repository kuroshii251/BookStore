<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Sign In</h1>
            <p class="text-gray-500 mt-1">Login untuk melanjutkan</p>
        </div>

        <form action="{{ route('logins') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email" name="email" id="email"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition"
                    placeholder="Masukkan email">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition"
                    placeholder="Masukkan password">
            </div>

            <button type="submit"
                class="w-full bg-black text-white py-2 rounded-lg font-semibold hover:bg-gray-800 transition duration-200">
                Login
            </button>

            <p class="text-sm mt-4 text-center text-gray-600">
                Don't have an account?
                <a href="/register" class="text-blue-600 hover:underline">Register</a>
            </p>

        </form>
    </div>

</body>

</html>
