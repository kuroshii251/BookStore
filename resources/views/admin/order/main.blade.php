
@extends('layouts.navbaradmin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Order</h1>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Image</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telp</th>

                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Bayar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $item->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->product_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->product_picture)
                                <img src="{{ asset('uploads/image/product_picture/' . $item->product_picture) }}" alt="Product" class="w-16 h-16 object-cover rounded-lg hover:scale-110 transition">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">Rp {{ number_format($item->quantity * $item->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                ($item->status == 'processing' ? 'bg-blue-100 text-blue-800' :
                                ($item->status == 'shipped' ? 'bg-purple-100 text-purple-800' :
                                ($item->status == 'delivered' ? 'bg-green-100 text-green-800' :
                                ($item->status == 'completed' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800'))))
                            }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ url('/admindashboard/order/' . $item->id . '/status') }}" method="POST" class="inline">
                                @csrf
                                <select name="status" class="px-2 py-1 border rounded text-xs focus:outline-none focus:ring-1">
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $item->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $item->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $item->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="ml-1 px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate" title="{{ $item->Alamat }}">{{ Str::limit($item->Alamat, 30) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_penerima }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->nomor_telepon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $item->payment_method == 'cod' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $item->payment_method == 'cod' ? 'COD' : 'Upload Payment' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->foto_payment)
                                <img src="{{ asset('storage/uploads/image/foto_payment/' . $item->foto_payment) }}" alt="Bukti Bayar" class="w-12 h-12 object-cover rounded-lg cursor-pointer hover:scale-110 transition" onclick="openModal('{{ $item->foto_payment }}')" title="Click to enlarge" data-full-src="{{ asset('storage/uploads/image/foto_payment/' . $item->foto_payment) }}">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="px-6 py-12 text-center text-gray-500 text-lg">Belum ada order</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg max-w-2xl max-h-screen overflow-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Bukti Pembayaran</h3>
            <button onclick="closeModal()" class="text-2xl font-bold">&times;</button>
        </div>
        <img id="modalImage" src="" alt="Bukti Bayar Full" class="w-full max-h-[70vh] object-contain">
    </div>
</div>

<script>
function openModal(fullSrc) {
    document.getElementById('modalImage').src = fullSrc;
    document.getElementById('paymentModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.addEventListener('click', function(e) {
    if (e.target.id === 'paymentModal') closeModal();
});
</script>

@endsection
