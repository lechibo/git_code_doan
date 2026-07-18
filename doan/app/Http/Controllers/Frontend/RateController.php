<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Profile;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function rateAjax(Request $request)
    {
        
        if(!Auth::check())
        {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập'
            ]);
        }
        $rate = Rate::where('id_blog', $request->id_blog)
                    ->where('id_user', Auth::id())
                    ->first();

        if($rate)
        {
            // user đã vote rồi => cập nhật
            $rate->rate = $request->rate;
            $rate->save();
        }
        else
        {
            // user chưa vote => thêm mới
            $rate = new Rate();

            $rate->id_blog = $request->id_blog;
            $rate->id_user = Auth::id();
            $rate->rate = $request->rate;

            $rate->save();
        }

        $avg = Rate::where('id_blog', $request->id_blog)->avg('rate');
        $count = Rate::where('id_blog', $request->id_blog)->count();
        
        
        $userRate = null;
        if (Auth::check()) {
            $userRate = Rate::where('id_blog', $request->id_blog)
                ->where('id_user', Auth::id())
                ->first();
        }
        $count = Rate::where('id_blog', $request->id_blog)->count();

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá thành công',
            'avg' => round($avg, 1),
            'count' => $count,
            'userRate' => $userRate ? $userRate->rate : null,
        ]);
        // dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show($id)
    {
        
    
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

