<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $carts = auth()->user()->carts()->with('product.user')->get();
        return view('user.cart.main', compact('carts'));
    }

     public function checkout(){
        $carts = auth()->user()->carts()->with('product.user')->get();

        return view('user.checkout.main', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $maxStock = (int) ($product->stock ?? 100);
        $request->validate([
            'quantity' => "required|numeric|min:1|max:{$maxStock}"
        ]);

        $quantity = (int) $request->quantity;
        $subtotal = $product->price * $quantity;
        $user = auth()->user();

        $cartItem = $user->carts()->where('product_id', $id)->first();
        if ($cartItem) {
            $newSubtotal = $product->price * $request->quantity;
            $cartItem->update([
                'quantity' => $request->quantity,
                'price' => $product->price,
                'subtotal' => $newSubtotal,
            ]);
            $message = 'Keranjang berhasil diupdate!';
        } else {
            $user->carts()->create([
                'product_id' => $id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
            ]);
            $message = 'Product berhasil ditambahkan ke keranjang!';
        }

        return redirect()->back()->with('success', $message);
    }


    public function update(){
        //
    }

    public function destroy($id){
        $cartItem = auth()->user()->carts()->findOrFail($id);
        $cartItem->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}
