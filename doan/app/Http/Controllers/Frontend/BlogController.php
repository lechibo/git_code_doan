<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Profile;
use App\Models\Rate;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập!";
        }
        $blog=blog::paginate(3);
        return view('frontend.blog.bloglist',compact('blog'));
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
    public function show($id)
    {
        
        $blogdetail=blog::findOrFail($id);
        $prev = blog::where('id', '<', $id)
                ->orderBy('id', 'desc')
                ->first();

        $next = blog::where('id', '>', $id)
                ->orderBy('id', 'asc')
                ->first();

        //rate
        $blog = Blog::find($id);

        $avg = Rate::where('id_blog', $id)->avg('rate');

        $count = Rate::where('id_blog', $id)->count();

        $userRate = null;

        if(Auth::check()){
            $userRate = Rate::where('id_blog', $id)
                ->where('id_user', Auth::id())
                ->first();
        }
        //render cmt
        $comments = Comment::where('id_blog', $id)
            ->orderBy('id', 'asc')
            ->get();
        return view('frontend.blog.blogdetail',compact(
            'blogdetail',
            'prev',
            'next', 
            'blog',
            'avg',
            'count',
            'userRate',
            'comments'));
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
