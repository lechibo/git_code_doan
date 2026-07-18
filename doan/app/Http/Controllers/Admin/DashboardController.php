<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile)
    {
        if (!Auth::check()) {
            return "ban chua dang nhap";
        }
        $user = Auth::user();
        
        // return [
        //     'email'=>$user->email,
        //     'name'=>$user->name,
        //     'id'=>$user->id
        // ];
        return view('admin.dashboard.dashboard',compact('user'));
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
    public function show(Profile $profile,string $id)
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
