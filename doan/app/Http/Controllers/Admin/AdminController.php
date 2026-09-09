<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Checkout;
use App\Http\Requests\ProductRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //purchases
    }
    /**
     * Display a listing of the resource.
     */
    public function Users(Request $request)
    {
        //Users
        // $users = User::all();
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
            
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.management.userslist', compact('users'));
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.management.edit-user', compact('user'));
    }
        public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'level' => ['required'],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
        ]);

        return redirect()
            ->route('admin.usermanagement')
            ->with('success', 'Cập nhật user thành công');
    }
    public function deleteUser($id)
    {
        if (Auth::id() == $id) {
            return redirect()
                ->route('admin.usermanagement')
                ->with('error', 'Bạn không thể xóa chính tài khoản của mình');
        }
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.usermanagement')
            ->with('success', 'Xóa user thành công');
    }
    /**
     * Display a listing of the resource.
     */
    public function Products(Request $request)
    {
        //Products
        // $products = Product::with('user')->get();
        $query = Product::with('user');

        if ($request->filled('search')) {
            // $query->where('name', 'like', '%' . $request->search . '%');
            $search = trim($request->search);

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $products = $query
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.management.productslist', compact('products'));
    }
    public function editProduct($id)
    {
        $product = Product::findOrFail($id); 
        $categories = Category::all();
        $brands = Brand::all();
        $images = json_decode($product->image, true) ?? [];

        return view('admin.management.edit-product', compact('product', 'categories', 'brands','images'));
    }

    
    public function updateProduct(Request $request, $id)
    {
        // Validate trực tiếp các trường bắt buộc (KHÔNG bắt buộc 'image')
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'id_category' => 'required',
            'id_brand'    => 'required',
            'status'      => 'required',
            'detail'      => 'required',
            'image.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate định dạng nếu có chọn ảnh
        ], [
            'name.required'        => 'Vui lòng nhập tên sản phẩm',
            'price.required'       => 'Vui lòng nhập giá sản phẩm',
            'id_category.required' => 'Vui lòng chọn danh mục',
            'id_brand.required'    => 'Vui lòng chọn thương hiệu',
            'detail.required'      => 'Vui lòng nhập chi tiết sản phẩm'
        ]);

        $product = Product::findOrFail($id);
        
        // Bỏ _token và _method khỏi dữ liệu lưu DB
        $data = $request->except(['_token', '_method', 'image_delete', 'image']);

        // Xử lý giảm giá: Nếu không có sale thì gán sale = 0
        $data['sale'] = ($request->status == 1) ? ($request->sale ?? 0) : 0;

        $oldImages = json_decode($product->image, true) ?? [];
        $deleteList = $request->input('image_delete', []);

        // Lọc ra danh sách ảnh cũ còn giữ lại
        $remainingImages = array_values(array_diff($oldImages, $deleteList));

        // Upload ảnh mới
        $newImages = [];
        if ($request->hasFile('image')) {
            $newImages = $this->xuly_image($request);
        }

        //  Gom tổng số ảnh
        $finalImages = array_merge($remainingImages, $newImages);

        //  Validate tối đa 3 ảnh
        if (count($finalImages) > 3) {
            return back()->withErrors(['image' => 'Sản phẩm chỉ được có tối đa 3 ảnh.'])->withInput();
        }

        // Xóa file vật lý đối với ảnh chọn xóa
        foreach ($deleteList as $deleteImage) {
            if (in_array($deleteImage, $oldImages)) {
                @unlink(public_path('images/product/' . $deleteImage));
                @unlink(public_path('images/product/' . str_replace('_full', '_329x380', $deleteImage)));
                @unlink(public_path('images/product/' . str_replace('_full', '_85x84', $deleteImage)));
            }
        }

        // Lưu mảng ảnh vào DB dưới dạng JSON
        $data['image'] = json_encode($finalImages);
        $product->update($data);

        return redirect()->route('admin.productmanagement')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    // Hàm hỗ trợ upload, resize ảnh
    private function xuly_image($request)
    {
        $uploadedImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $fullName = pathinfo($imageName, PATHINFO_FILENAME);
                $duoi = $file->getClientOriginalExtension();

                $imagefull = $fullName . '_full.' . $duoi;
                $image329 = $fullName . '_329x380.' . $duoi;
                $image85 = $fullName . '_85x84.' . $duoi;

                // Lưu file gốc
                $file->move(public_path('images/product/'), $imagefull);
                $uploadedImages[] = $imagefull;

                // Resize ảnh bằng Intervention Image
                $path = public_path('images/product/' . $imagefull);
                \Image::read($path)->resize(329, 380)->save(public_path('images/product/' . $image329));
                \Image::read($path)->resize(85, 84)->save(public_path('images/product/' . $image85));
            }
        }
        return $uploadedImages;
    }


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Nếu sản phẩm có ảnh, nên xóa file ảnh trong thư mục storage/public trước khi xóa record
        // if ($product->image && Storage::exists($product->image)) {
        //     Storage::delete($product->image);
        // }

        $product->delete();

        return redirect()
            ->route('admin.productmanagement')
            ->with('success', 'Xóa sản phẩm thành công');
    }
    /**
     * Display a listing of the resource.
     */
    public function Purchases(Request $request)
    {
        //Purchases
        // $checkouts = Checkout::with('user')
        // ->orderBy('created_at', 'desc')
        // ->get();
        
        $query = Checkout::with('user');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $checkouts = $query
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($checkouts->pluck('name'));

        return view('admin.management.purchaseslist', compact('checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
