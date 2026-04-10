<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-5">

        <a href="/" class="font-bold text-3xl text-black">
            BookPedia
        </a>

        <div class="flex items-center gap-6">

            @auth
            <form action="/dashboard" method="GET" class="flex items-center">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search products..."
                    class="border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
                    Search
                </button>
            </form>

            <a href="/dashboard/chat" class="text-gray-700 font-semibold hover:text-blue-600">Chat</a>
            <a href="/dashboard/order" class="text-gray-700 font-semibold hover:text-blue-600">Order</a>
            <a href="/dashboard/cart" class="text-gray-700 font-semibold hover:text-blue-600">Cart</a>

            <form action="/logout" method="POST">
                @csrf
                <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">
                    Logout
                </button>
            </form>

            @endauth


            @guest

            <a href="#about" class="text-gray-700 font-semibold hover:text-blue-600">About</a>
            <a href="#products" class="text-gray-700 font-semibold hover:text-blue-600">Product</a>
            <a href="#contact" class="text-gray-700 font-semibold hover:text-blue-600">Contact</a>

            <a href="/login" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">
                Login
            </a>

            @endguest

        </div>

    </div>
</div>

<div class="max-w-7xl mx-auto p-6">
    @yield('contents')
</div>

@include('layouts.footer')

</body>
</html>
