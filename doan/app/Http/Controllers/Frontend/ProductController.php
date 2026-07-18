<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // myproduct
        $products = Product::where('id_user', Auth::id())->get();
        return view('frontend.product.myproduct', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return "ban chua dang nhap";
        }
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.addproduct', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest  $request)
    {
        $data = $request->all();

        $data['id_user'] = Auth::id();

        // Upload nhiều ảnh
        
        if ($request->hasFile('image')) {

            $images = [];

            foreach ($request->file('image') as $file) {

                $imageName = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('images/product'), $imageName);

                $images[] = $imageName;
            }

            $data['image'] = json_encode($images);
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
