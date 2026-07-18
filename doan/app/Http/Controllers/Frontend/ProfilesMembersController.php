<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;

class ProfilesMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // myproduct
        return view('frontend.product.myproduct');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //addproduct
        // return view('frontend.product.addproduct');
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
    public function Postupdate(UpdateProfileRequest $request, Profile $profile){
  
        
        $userid=Auth::id();
        $user=Profile::findOrFail($userid);
        $data=$request->all();
        $file=$request->avatar;
        if($request->hasFile('avatar')){
            // Xóa avatar cũ
            if (!empty($user->avatar) && $user->avatar != 'default.png') {

                $oldImage = public_path('frontend/images/users/'.$user->avatar);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            // Upload avatar mới
            $file = $request->file('avatar');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('frontend/images/users'), $filename);

            $data['avatar'] = $filename;
        }
        if($data['password']){
            $data['password']=bcrypt($data['password']);

        }else{
            $data['password']=$user->password;

        }
        // $data = $request->except('_token');
        if($user->update($data)){
            
            return redirect()->back()->with('success','update thanh cong!');

        }else{
            return redirect()->back()->withErrors('update that bai!');
        }
            
        

    }
    public function Getupdate(){
        if(!Auth::check()){
            return "ban chua login!";
        }
        $user=Auth::user();
        $country=Country::all();


        return view('frontend.member.account',compact('user','country'));
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
