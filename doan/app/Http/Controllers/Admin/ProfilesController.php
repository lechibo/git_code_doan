<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function show(Profile $profile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function Postupdate(UpdateProfileRequest $request, Profile $profile){
        // dd('đã click');
        // $request->validate([
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|string|max:255',
        //     'password'=>'nullable|string|min:8',
        //     'phone'=>'nullable|numeric|min:0',
        //     'address'=>'nullable|string|max:255',
        //     'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            
        // ]);
        
        $userid=Auth::id();
        $user=Profile::findOrFail($userid);
        $data=$request->all();
        $file=$request->avatar;
        if(!empty($file)){
            $data['avatar']=$file->getClientOriginalName();
        }
        if($data['password']){
            $data['password']=bcrypt($data['password']);

        }else{
            $data['password']=$user->password;

        }
        // $data = $request->except('_token');
        if($user->update($data)){
            if(!empty($file)){
                $file->move(public_path('admin/images/users'),$file->getClientOriginalName());
            }
            return redirect()->back()->with('success','update thanh cong!');

        }else{
            return redirect()->back()->withErrors('update that bai!');
        }
            
        
        // $data=$request->only([
        //     'name',
        //     'email',
        //     'phone',
        //     'address',
        //     'id_country'
            
        // ]);
        // Nếu có nhập password mới
        // if ($request->filled('password')) {
        //     $data['password'] = bcrypt($request->password);
        // } 
        // Nếu có upload avatar
        // if ($request->hasFile('avatar')) {
        //     // echo "dsjdsd";
        //     $file = $request->file('avatar');

        //     $filename = time() . '_' . $file->getClientOriginalName();//lấy tên file
        //     // echo 'Đuôi file:'.$file->getClientOriginalExtension();//lấy đuôi file
        //     // echo 'Đường dẫn tạm:'.$file->getRealPath();//đường dẫn tạm thời của file
        //     // echo 'Kích cỡ file:'.$file->getSize();
        //     // echo 'Kiểu file:'.$file->getMimeType();

        //     $file->move(public_path('admin/images/users'), $filename);

        //     $data['avatar'] = $filename;
        // }
        // dd($data);
        // dd(Auth::id());
        // if(Profile::where('id', Auth::id())->update($data)){
        //     return redirect()->back()->with('success','Update thành công!');
        // }
        // $result = Profile::where('id', Auth::id())->update($data);
        // dd($result);
        

    }
    public function Getupdate(Request $request, Profile $profile)
    {
        if (!Auth::check()) {
            return "ban chua dang nhap";
        }
        $user = Auth::user();
        $country= Country::all();
        // return [
        //     'email'=>$user->email,
        //     'name'=>$user->name,
        //     'id'=>$user->id
        // ];
        return view('admin.user.profile',compact('user','country'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
