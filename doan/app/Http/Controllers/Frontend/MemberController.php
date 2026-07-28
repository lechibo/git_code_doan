<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Product;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if(!Auth::check()){
            return "Bạn chưa đăng nhập!";
        }
        $user=Auth::user();
        // show homeproduct
        $products = Product::orderBy('created_at', 'desc')
        ->take(6)
        ->get();
        return view('frontend.layouts.app',compact('user','products'));
    }
    /**
     * Login.
     */
    public function Postlogin(MemberLoginRequest $request)
    {
        $login=[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        $remember=false;
        if($request->remember_me){
            $remember=true;
        }
        if(Auth::attempt($login,$remember)){
            $user=Auth::user();
            if($user->level==1){
                return redirect()->route('profile.index');
            }else{
                return redirect()->route('appfe');
            }
        }
        return redirect()->back()->with('error', 'Sai email hoặc mật khẩu');
        
    }
    public function login(Request $request)
    {
        return view('frontend.member.login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function Postcreate(MemberRegisterRequest $request)
    {

        // $request->validate([
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|email|unique:users,email',
        //     'password'=>'required|string|min:8|max:255'
        // ]);
        $data= $request->only([
            'name',
            'email',
            'password'
        ]);
        $data['password'] = Hash::make($request->password);
        $data['level'] = 0;
        if(Profile::create($data)){
            return redirect()->back()->with('success','Register thành công!');
        }
        
    }
    public function create()
    {
        return view('frontend.member.register');
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
