<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('user.order.main', compact('orders'));
    }

    public function userOrders()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('user.order.main', compact('orders'));
    }

 public function store(Request $request)
{
$request->validate([
        'Alamat' => 'required|string|max:255',
        'nama_penerima' => 'required|string|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'payment_method' => 'required|in:upload_payment,cod',
        'foto_payment' => 'required_if:payment_method,upload_payment|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $user = auth()->user();
    $carts = $user->carts()->with('product')->get();

    if ($carts->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang kosong!');
    }

    if ($request->payment_method === 'upload_payment') {
        $filePath = $request->file('foto_payment')
            ->store('uploads/image/foto_payment', 'public');
    } else {
        $filePath = null;
    }

    foreach ($carts as $cart) {
        $product = $cart->product;

        if ($product->stock < $cart->quantity) {
            return redirect()->back()->with(
                'error',
                "Stok tidak mencukupi untuk {$product->product_name}. Stok tersedia: {$product->stock}"
            );
        }

        $product->stock -= $cart->quantity;
        $product->save();

        Order::create([
            'user_id' => $user->id,
            'product_name' => $product->product_name,
            'quantity' => (string) $cart->quantity,
            'harga' => (string) $cart->price,
            'foto_payment' => $filePath,
            'Alamat' => $request->Alamat,
            'nama_penerima' => $request->nama_penerima,
            'product_picture' => $product->product_picture,
            'nomor_telepon' => $request->nomor_telepon,
'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);
    }

    $user->carts()->delete();

    return view('user.status.success')->with('success', 'Order berhasil dibuat! Silakan tunggu konfirmasi.');
}
public function show(){
        $data = Order::with('user')->get();
return view('admin.order.main', compact('data'));
}

public function showToUser(){
 $data = auth()->user()->orders()->with('user')->get();
return view('user.order.main', compact('data'));
}

public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,completed'
    ]);

    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status order berhasil diupdate!');
}
}

