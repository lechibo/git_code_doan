<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\facades\Auth;


class CartController extends Controller
{
    private function calculateCart(&$cart)
    {
        $subTotal = 0;

        foreach ($cart as &$item) {

            $price = ($item['sale'] == 0)
                ? $item['price']
                : $item['price'] * ((100 - $item['sale']) / 100);

            $item['price_sale'] = $price;
            $item['total'] = $price * $item['qty'];

            $subTotal += $item['total'];
        }

        unset($item);

        return $subTotal;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // session()->forget('cart');
        // dd(session('cart'));
        $cart = session('cart', []);
        $subTotal = $this->calculateCart($cart);

        return view('frontend.cart.cart', compact('cart','subTotal'));
    }
    /**
     * Show the form for adding a new resource.
     */
    public function add(Request $request,$id)
    {   
        // $product = Product::findOrFail($id);
        // $cart = Cart::where('id_user', Auth::id())
        //             ->where('id_product', $id)
        //             ->first();

        // if ($cart) {
        //     $cart->increment('qty');
        // } else {
        //     Cart::create([
        //         'id_user' => Auth::id(),
        //         'id_product' => $id,
        //         'qty' => 1,
        //     ]);
        // }
        
        $product = Product::findOrFail($id);
        
        $images = json_decode($product->image, true);
        
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
           
            $cart[$id] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'sale'  => $product->sale,              
                'qty'   => 1,
                'image' => $images,
            ];
        }
        session()->put('cart', $cart);
        if (Auth::check()) {
            
            $cartDB = Cart::where('id_user', Auth::id())
            ->where('id_product', $id)
            ->first();
            if ($cartDB) {
                $cartDB->increment('qty');
            } else {
                Cart::create([
                    'id_user' => Auth::id(),
                    'id_product' => $id,
                    'qty' => 1,
                ]);
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng',
                
            ]);
        }
        
        // dd(session('cart'));
        // return redirect()->route('cart.index');
    }
    public function increase($id, Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;

            Cart::where('id_user', Auth::id())
            ->where('id_product', $id)
            ->increment('qty');
        }
        

        $subTotal = $this->calculateCart($cart);
        session()->put('cart', $cart);

        return response()->json([
            'success'=>true,
            'message'=>'Đã tăng qty +1',
            'qty'=>$cart[$id]['qty'],
            'total' => $cart[$id]['total'],
            'subTotal' => $subTotal,
            'cartCount'=>count($cart)
        ]);


        // return redirect()->back();
    }
    public function decrease($id, Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty']--;

                Cart::where('id_user', Auth::id())
                ->where('id_product', $id)
                ->decrement('qty');
            } 
          
        }
        

        $subTotal = $this->calculateCart($cart);
        session()->put('cart', $cart);
        return response()->json([
            'success'=>true,
            'message'=>'Đã giảm qty -1',
            'qty' => $cart[$id]['qty'],
            'total' => $cart[$id]['total'],
            'subTotal' => $subTotal,
            'cartCount' => count($cart)
        ]);

        // return redirect()->back();
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
    public function destroy( $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]); // delete theo id
        }
        $subTotal = $this->calculateCart($cart);
        session()->put('cart', $cart); // update session

        Cart::where('id_user', Auth::id())
        ->where('id_product', $id)
        ->delete();

        return response()->json([
        'success' => true,
        'message' => 'Đã xóa sản phẩm',
        'subTotal' => $subTotal,
       
        'cartCount' => count($cart)
    ]);
    }
}
