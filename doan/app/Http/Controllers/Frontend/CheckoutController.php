<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Mail\CheckoutMail;

use Illuminate\Support\facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session('cart', []);

        $subTotal = 0;

        foreach ($cart as &$item) {

            $price = ($item['sale'] == 0)
                ? $item['price']
                : $item['price'] * ((100 - $item['sale']) / 100);

            $item['price_sale'] = $price;
            $item['total'] = $price * $item['qty'];

            $subTotal += $item['total'];
        }

        return view('frontend.sendMail.checkout', compact('cart','subTotal'));
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
    public function store(CheckoutRequest $request)
    {
        
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống.');
        }

        if (!Auth::check()) {

            // Tạo tài khoản
            $data= $request->only([
            'name',
            'email',
            'password'
            ]);
            $data['password'] = Hash::make($request->password);
            $data['level'] = 0;
            $user = User::create($data);
            if($user){
                // return redirect()->back()->with('success','Register thành công!');
                // Đăng nhập
                Auth::login($user);
                return back()->with('success', 'Đã đăng ký thành công');
            }else {
                return back()->with('error', 'Không tạo được user');
            }
        }

        

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        
        $checkout = Checkout::create([
            'email'       => $request->email,
            'phone'       => $request->phone,
            'name'        => $request->name,
            'id_user'     => Auth::id(),
            'price' => $total,
        ]);

        
        Mail::to($request->email)->send(new CheckoutMail(
            $request->all(),
            $cart
        ));

        session()->forget('cart');

        return redirect()->back()->with('success', 'Đặt hàng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
