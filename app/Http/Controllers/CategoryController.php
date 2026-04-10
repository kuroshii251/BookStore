<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

public function index(){

}
public function store(Request $request){
$data = $request->validate([
'category_name'=>'required'
]);

auth()->user()->categories()->create($data);
return back()->with('success', 'berhasil menambahkan category');
}

 public function show()
    {
        $data = Category::all()->map(function ($category) {
            $category->product_count = \App\Models\Product::where('category', $category->category_name)->count();
            return $category;
        });
        return view('admin.category.main', compact('data'));
    }

public function showToTambahProduk()
    {
$categorydata = Category::all();
        return view('admin.product.tambah', compact('categorydata'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.update', compact('category'));
    }
public function update(Request $request, $id){

$datass = $request->validate([
'category_name'=>'required'
]);

$category = Category::findOrFail($id);

$category->update($datass);
$data = Category::all()->map(function ($cat) {
    $cat->product_count = \App\Models\Product::where('category', $cat->category_name)->count();
    return $cat;
});
return view('admin.category.main', compact('data'))->with('success', 'berhasil update category');

}

public function destroy($id){
    $category = Category::findOrFail($id);
    if (\App\Models\Product::where('category', $category->category_name)->exists()) {
        return back()->with('error', 'Cannot delete category - it is used by products.');
    }
    $category->delete();
    return back()->with('success', 'Category berhasil dihapus');

}
}
