<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Postcreate(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|string|max:255'
            ]
        );
        $data=$request->only(
            [
                'name'
            ]
        );
        Category::create([
            'name'=>$request->name
        ]);
        return redirect()->route('category.list')->with('success','Add thành công!');

    }
    public function Getcreate()
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        return view('admin.category.addcategory');
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
    public function show(Category $category)
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        $category=Category::all();

        return view('admin.category.listcategory',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('category.list')->with('success', 'Xóa thành công!');
    }
    public function Getdelete($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.deletecategory', compact('category'));
    }

}
