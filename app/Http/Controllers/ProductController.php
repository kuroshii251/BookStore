<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

public function mainpage(){
return view('index');
}

public function admindashboard(){
    $totalUsers = User::count();
    $totalOrders = Order::count();
    $totalBuyers = User::has('orders')->count();
    $totalRevenue = DB::table('orders')->sum(DB::raw('quantity * harga'));
    $recentOrders = Order::with('user')->latest()->take(5)->get();
    $recentUsers = User::latest()->take(5)->get();

    return view('admin.index', compact('totalUsers', 'totalOrders', 'totalBuyers', 'totalRevenue', 'recentOrders', 'recentUsers'));
}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('user');

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('product_name', 'LIKE', "%{$request->q}%")
                  ->orWhere('author', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(12);

        $categories = Product::distinct()->pluck('category')->filter()->values();

        return view('user.dashboard.main', compact('products', 'categories'));
    }


   public function userview() {
    $data = User::paginate(10);

    return view('admin.user.main', compact('data'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
return view('admin.product.tambah');

    }


    public function product(){
        return view('admin.product.main');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$data = $request->validate([
'product_name'=>'required',
'category'=>'required',
'description'=>'required',
'price'=>'required|numeric',
'author'=>'required',
'stock'=>'required|numeric',
'product_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

]);


if ($request->hasFile('product_picture')) {
    $file = $request->file('product_picture');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move(public_path('uploads/image/product_picture'), $filename);

    $data['product_picture'] = $filename;
}

auth()->user()->products()->create($data);

$data = Product::with('user')->get();
return view('admin.product.main', compact('data'))->with('success', 'Product berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
$data = Product::with('user')->get();
        return view('admin.product.main', compact('data'));
    }

public function showProductToUser()
    {
        return $this->index(request());
    }

public function showProduct($id){
    $data = Product::with('user')->findOrFail($id);
            return view('user.product.details', compact('data'));
             }
    /**
     *
     *
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = auth()->user()->products()->findOrFail($id);
        return view('admin.product.update', compact('product'));
    }


  public function showUser(){
$data=User::latest()->get();
return view('admin.user.main', compact('data'));

}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
$datas = $request->validate([
'product_name'=>'required',
'category'=>'required',
'description'=>'required',
'price'=>'required|numeric',
'author'=>'required',
'stock'=>'required|numeric',
'product_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
]);

$product = auth()->user()->products()->findOrFail($id);

if ($request->hasFile('product_picture')) {
    if ($product->product_picture && file_exists(public_path('uploads/image/product_picture/' . $product->product_picture))) {
        unlink(public_path('uploads/image/product_picture/' . $product->product_picture));
    }
    $file = $request->file('product_picture');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads/image/product_picture'), $filename);
    $datas['product_picture'] = $filename;
}

$product->update($datas);

$data = Product::with('user')->get();
return view('admin.product.main', compact('data'))->with('success', 'Product berhasil diupdate!');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy(string $id)
    {
Product::findOrFail($id)->delete();
return back()->with('success', 'Product berhasil dihapus');

    }
}

