@extends('layouts.navbar')

@section('contents')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-2xl p-8 text-center max-w-md w-full">

        <h2 class="text-2xl font-bold text-green-600 mb-4">
            Berhasil 🎉
        </h2>

        <p class="text-gray-600 mb-6">
            Pesanan atau aksi kamu sudah berhasil diproses.
        </p>

        <a href="/dashboard"
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
            Kembali ke Dashboard
        </a>

    </div>
</div>
@endsection
