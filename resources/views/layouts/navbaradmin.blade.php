<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <div class="w-64 shrink-0 bg-black text-white flex flex-col p-6 space-y-6">
        <h1 class="text-2xl font-bold">BookPedia</h1>

        <nav class="flex flex-col space-y-3">
            <a href="/admindashboard" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">Dashboard</a>
            <a href="/admindashboard/product" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">Product</a>
            <a href="/admindashboard/category" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">Category</a>
<a href="/admindashboard/order" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">Order</a>
            <a href="/admindashboard/chat" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">Chat</a>
            <a href="/admindashboard/user" class="hover:bg-gray-800 px-3 py-2 rounded-lg transition">User</a>
        </nav>

        <div class="flex-1"></div>

        <form action="{{ URL('/logout') }}" method="POST">
            @csrf
            <button class="w-full bg-gray-800 font-bold hover:bg-gray-700 py-2 rounded-lg transition">
                Logout
            </button>
        </form>
    </div>

    <div class="flex-1 overflow-x-auto p-8">


        <div class="p-6">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
