<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function product()
    {
        $title = 'Products';
        $productList = Product::get();
        return view('Admin.product.list', compact('productList', 'title'));
    }

    public function productCreate()
    {
        $title = 'Create Product';
        $key = 'add';
        $categories = Category::get();
        return view('Admin.product.add', compact('title', 'key', 'categories'));
    }


    public function productStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'category' => 'required',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:512',
        ]);
        $product = new Product();
        if ($request->hasFile('image')) {
            $fileName = preg_replace('/[0-9\/\@\.\;\" "]+/', '', 'blog') . time() . '.' . $request->image->getClientOriginalExtension();
            $target = 'uploads/products/' . $fileName;
            $request->image->move(public_path('uploads/products/'), $fileName);
            $product->image = $target;
        }
        $product->title = $request->title;
        $product->category_id = $request->category;
        $product->price = $request->price ?? 0;
        $product->stock = $request->stock;
        $product->description = $request->description;
        if ($product->save()) {
            session()->flash('success', 'Product has been created successfully');
            return redirect('product');
        } else {
            return back()->with('error', 'Error while creating product');
        }
    }


    public function productEdit($id)
    {
        if ($id > 0) {
            $product = Product::find($id);
            $categories = Category::get();
            $title = 'Edit Product';
            $key = 'Edit';
            return view('Admin.product.add', compact('title', 'key', 'product', 'categories'));
        } else {
            return back()->with('error', 'Error product ID not Found');
        }
    }


    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'category' => 'required',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:512',
        ]);
        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $fileName = preg_replace('/[0-9\/\@\.\;\" "]+/', '', 'blog') . time() . '.' . $request->image->getClientOriginalExtension();
            $target = 'uploads/products/' . $fileName;
            $request->image->move(public_path('uploads/products/'), $fileName);
            $product->image = $target;
        }
        $product->title = $request->title;
        $product->category_id = $request->category;
        $product->price = $request->price ?? 0;
        $product->stock = $request->stock;
        $product->description = $request->description;
        if ($product->save()) {
            session()->flash('success', 'Product has been updated successfully');
            return redirect('product');
        } else {
            return back()->with('error', 'Error while creating product');
        }
    }

    public function deleteProduct($id)
    {
        if ($id > 0) {
            $product = Product::find($id);
            if ($product->delete()) {
                echo(json_encode(array('status' => true)));
            } else {
                echo(json_encode(array('status' => false, 'message' => 'Some error occured,please try after sometime')));
            }
        }
    }
}
