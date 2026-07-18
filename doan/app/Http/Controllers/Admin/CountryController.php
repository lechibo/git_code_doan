<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
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
        Country::create([
            'name'=>$request->name
        ]);
        return redirect()->route('country.list')->with('success','Add thành công!');

    }
    public function Getcreate()
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        return view('admin.country.addcountry');
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
    public function show(Country $country)
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        $country=Country::all();

        return view('admin.country.listcountry',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Country::findOrFail($id)->delete();
        return redirect()->route('country.list')->with('success', 'Xóa thành công!');
    }
    public function Getdelete($id)
    {
        $country = Country::findOrFail($id);

        return view('admin.country.deletecountry', compact('country'));
    }

}
