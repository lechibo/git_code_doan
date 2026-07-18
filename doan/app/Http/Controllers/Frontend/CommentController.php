<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    /**
     * Display a listing of the comments.
     */
    public function ajaxcomment(Request $request )
    {
        
        $comment = Comment::create([
            'cmt' => $request->cmt,
            'id_user' => Auth::id(),
            'id_blog' => $request->id_blog,
            'avatar_user' => Auth::user()->avatar ?? '',
            'name_user' => Auth::user()->name ?? '',
            'level' => $request->level ?? 0 
        ]);
        $comment->load('user');

        // 4. Trả về Ajax
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
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
