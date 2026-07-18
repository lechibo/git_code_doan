<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
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
        Brand::create([
            'name'=>$request->name
        ]);
        return redirect()->route('brand.list')->with('success','Add thành công!');

    }
    public function Getcreate()
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        return view('admin.brand.addbrand');
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
    public function show(Brand $brand)
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        $brand=Brand::all();

        return view('admin.brand.listbrand',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect()->route('brand.list')->with('success', 'Xóa thành công!');
    }
    public function Getdelete($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.deletebrand', compact('brand'));
    }

}
