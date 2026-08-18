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
use Intervention\Image\Laravel\Facades\Image;

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
    public function search(Request $request)
    {
        $keyword = $request->name;

        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->paginate(9);

        return view('frontend.product.search', compact('products', 'keyword'));
    }
    public function searchAdvanced(Request $request)
    {
        $query = Product::query();

        if($request->filled('name'))
            //$request->filled('name') =Input::has('name')
        {
            $query->where('name','like','%'.$request->name.'%');
            //$request->name=Input::get('name')
        }

        if($request->filled('category'))
        {
            $query->where('id_category',$request->category);
        }

        if($request->filled('brand'))
        {
            $query->where('id_brand',$request->brand);
        }

        if($request->filled('status'))
        {
            $query->where('status', $request->status);
        }

        if ($request->filled('price')) {

        switch ($request->price) {

            case '1':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) BETWEEN ? AND ?
                ", [0, 1000]);
                break;

            case '2':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) BETWEEN ? AND ?
                ", [1000, 5000]);
                break;

            case '3':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) > ?
                ", [5000]);
                break;
        }
    }

        $products = $query->paginate(9)->withQueryString();

        $categories = Category::all();

        $brands = Brand::all();

        return view(
            'frontend.product.searchadvanced',
            compact(
                'products',
                'categories',
                'brands'
            )
        );
    }
    
    public function searchAdvancedAjax(Request $request)
    {
        $query = Product::query();

        if($request->filled('name'))
            //$request->filled('name') =Input::has('name')
        {
            $query->where('name','like','%'.$request->name.'%');
            //$request->name=Input::get('name')
        }

        if($request->filled('category'))
        {
            $query->where('id_category',$request->category);
        }

        if($request->filled('brand'))
        {
            $query->where('id_brand',$request->brand);
        }

        if($request->filled('status'))
        {
            $query->where('status', $request->status);
        }

        if ($request->filled('price')) {

        switch ($request->price) {

            case '1':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) BETWEEN ? AND ?
                ", [0, 1000]);
                break;

            case '2':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) BETWEEN ? AND ?
                ", [1000, 5000]);
                break;

            case '3':
                $query->whereRaw("
                    (
                        CASE
                            WHEN status = 1
                            THEN price * (100 - sale) / 100
                            ELSE price
                        END
                    ) > ?
                ", [5000]);
                break;
        }
    }

        $products = $query->paginate(9)->withQueryString();

        $categories = Category::all();

        $brands = Brand::all();

        
        // Nếu gọi bằng AJAX
    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.product.product_listForsearchadvanced_ajax', compact('products', 'categories', 'brands'))->render()
        ]);
    }
    // Nếu load trang bình thường
    return view('frontend.product.searchadvancedajax', compact('products', 'categories', 'brands'));
    }

    public function searchPriceBar(Request $request){
        // Lấy tham số từ Request
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 5000);
        $pageType = $request->input('page_type', 'home');

        // Query chung lọc theo giá
        $query = Product::whereBetween('price', [$minPrice, $maxPrice]);

        $categories = Category::all();

        $brands = Brand::all();

        // Lấy 6 sản phẩm mới nhất
        if ($pageType === 'home') {
            $products = $query->latest()->take(6)->get();

           
            return view('frontend.product.product_listForsearchadvanced_ajax', compact('products', 'categories', 'brands'))->render();
        } 

        //  Trang Search Advanced
        if ($pageType === 'searchadvanced') {
            if ($request->filled('keyword')) {
                $query->where('name', 'like', '%' . $request->input('keyword') . '%');
            }
            $products = $query->paginate(9)->withQueryString();

            
            return view('frontend.product.product_listForsearchadvanced_ajax', compact('products', 'categories', 'brands'))->render();
        } 

        // Trang Search Advanced Ajax
        if ($pageType === 'searchadvancedajax') {
            if ($request->filled('keyword')) {
                $query->where('name', 'like', '%' . $request->input('keyword') . '%');
            }
            $products = $query->paginate(9)->withQueryString();

            
            return view('frontend.product.product_listForsearchadvanced_ajax', compact('products', 'categories', 'brands'))->render();
        }

        $products = $query->paginate(9)->withQueryString();

        // Nếu gọi bằng AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.product.product_listForsearchadvanced_ajax', compact('products', 'categories', 'brands'))->render()
            ]);
        }
        
        // return view('frontend.product.searchadvancedajax', compact('products', 'categories', 'brands'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function Getadd()
    {
        if (!Auth::check()) {
            return "ban chua dang nhap";
        }
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.addproduct', compact('categories', 'brands'));
    }
    public function xuly_image(ProductRequest  $request){
        foreach ($request->file('image') as $file) {

                $imageName = time().'_'.$file->getClientOriginalName();
                $fullName=pathinfo($imageName,PATHINFO_FILENAME);
                $duoi=$file->getClientOriginalExtension();

                $imagefull=$fullName.'_full.'.$duoi;
                $image329=$fullName.'_329x380.'.$duoi;
                $image85=$fullName.'_85x84.'.$duoi;

                //lưu full
                $file->move(public_path('images/product/'), $imagefull);
                $images[] = $imagefull;
                //resize
                $path=public_path('images/product/'.$imagefull);

                Image::read($path)
                ->resize(329,380)
                ->save(public_path('images/product/'.$image329));
                Image::read($path)
                ->resize(85,84)
                ->save(public_path('images/product/'.$image85));
            }
            return $images;
        }
    /**
     * Store a newly created resource in storage.
     */
    public function Postadd(ProductRequest  $request)
    {
        $data = $request->all();

        $data['id_user'] = Auth::id();

        $data['sale'] = $data['status'] == 1 ? $data['sale']: 0;

        // Upload nhiều ảnh
        
        if ($request->hasFile('image')) {

            $images = [];

            // foreach ($request->file('image') as $file) {

            //     $imageName = time().'_'.$file->getClientOriginalName();
            //     $fullName=pathinfo($imageName,PATHINFO_FILENAME);
            //     $duoi=$file->getClientOriginalExtension();

            //     $imagefull=$fullName.'_full.'.$duoi;
            //     $image329=$fullName.'_329x380.'.$duoi;
            //     $image85=$fullName.'_85x84.'.$duoi;

            //     //lưu full
            //     $file->move(public_path('images/product/'), $imagefull);
            //     $images[] = $imagefull;
            //     //resize
            //     $path=public_path('images/product/'.$imagefull);

            //     Image::read($path)
            //     ->resize(329,380)
            //     ->save(public_path('images/product/'.$image329));
            //     Image::read($path)
            //     ->resize(85,84)
            //     ->save(public_path('images/product/'.$image85));

               
            // }
            $images =$this->xuly_image($request);
  
            $data['image'] = json_encode($images);
        }

        Product::create($data);

        return redirect()->route('account.myproduct')->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show_productdetail($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->image, true);
        return view('frontend.product.productdetail',compact('product','images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Postedit(ProductRequest  $request,$id)
    {
        // $product = Product::findOrFail($id);
        $product = Product::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();
        $data = $request->all();
        $data['sale'] = $data['status'] == 1 ? $data['sale']: 0;
        $oldImages = json_decode($product->image, true);
        if (!$oldImages) {
            $oldImages = [];
        }

        if ($request->has('image_delete')) {

            foreach ($request->image_delete as $deleteImage) {
                $key = array_search($deleteImage, $oldImages);
                if ($key !== false) {

                    unset($oldImages[$key]);
                    $pathFull = public_path('images/product/'.$deleteImage);
                    $path329 = public_path('images/product/'.str_replace('_full', '_329x380', $deleteImage));
                    $path85 = public_path('images/product/'.str_replace('_full', '_85x84', $deleteImage));

                    if (file_exists($pathFull)) {
                        unlink($pathFull);
                    }

                    if (file_exists($path329)) {
                        unlink($path329);
                    }

                    if (file_exists($path85)) {
                        unlink($path85);
                    }

                }

            }

            $oldImages = array_values($oldImages);

        }
        $newImages = [];
        // Upload nhiều ảnh
        if ($request->hasFile('image')) {

            // foreach ($request->file('image') as $file) {

            //     $imageName = time().'_'.$file->getClientOriginalName();
            //     $fullName=pathinfo($imageName,PATHINFO_FILENAME);
            //     $duoi=$file->getClientOriginalExtension();

            //     $imagefull=$fullName.'_full.'.$duoi;
            //     $image329=$fullName.'_329x380.'.$duoi;
            //     $image85=$fullName.'_85x84.'.$duoi;

            //     //lưu full
            //     $file->move(public_path('images/product/'), $imagefull);
            //     $newImages[] = $imagefull;
            //     //resize
            //     $path=public_path('images/product/'.$imagefull);

            //     Image::read($path)
            //     ->resize(329,380)
            //     ->save(public_path('images/product/'.$image329));
            //     Image::read($path)
            //     ->resize(85,84)
            //     ->save(public_path('images/product/'.$image85));

               
            // }
            $newImages =$this->xuly_image($request);
        }
        $images = array_merge($oldImages, $newImages);
        if(count($images) > 3){

            return back()->withErrors(['image' => 'Chỉ được tối đa 3 ảnh.'])->withInput();

        }
        
        $data['image'] = json_encode($images);
        $product->update($data);

        return redirect()->route('account.myproduct')->with('success', 'Update sản phẩm thành công.');
    }
    public function Getedit($id)
    {
        if (!Auth::check()) {
            return "ban chua dang nhap";
        }

        // $product = Product::findOrFail($id);
        $product = Product::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $categories = Category::all();
        $brands = Brand::all();

        $images = json_decode($product->image, true);

        return view('frontend.product.editproduct',compact('product', 'categories', 'brands', 'images'));
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
    public function Postdestroy($id)
    {
        $product = Product::where('id', $id)
        ->where('id_user', Auth::id())
        ->firstOrFail();

        $images = json_decode($product->image, true) ?? [];

        foreach ($images as $image) {

            $full = public_path('images/product/'.$image);
            $img329 = public_path(
                'images/product/'.
                str_replace('_full', '_329x380', $image)
            );
            $img85 = public_path(
                'images/product/'.
                str_replace('_full', '_85x84', $image)
            );

            if (file_exists($full)) {
                unlink($full);
            }

            if (file_exists($img329)) {
                unlink($img329);
            }

            if (file_exists($img85)) {
                unlink($img85);
            }
        }

        $product->delete();

        return redirect()
            ->route('account.myproduct')
            ->with('success', 'Xóa sản phẩm thành công.');
    }
    public function Getdestroy($id){
        $product = Product::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

    return view('frontend.product.deleteproduct', compact('product'));
    }

}
