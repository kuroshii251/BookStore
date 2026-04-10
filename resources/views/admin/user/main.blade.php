@extends('layouts.navbaradmin')

@section('content')


<div class="">
<h1 class="font-bold text-2xl mb-3">List User</h1>
<table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Email</th>

                    </tr>
                    </thead>
                <tbody class="bg-gray-50">
                    <tr>
                        @foreach ($data as $item )
<tr>
                         <td class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">{{ $item->id }}</td>
                        <td class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">{{ $item->email }}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
                    </div>
@endsection
