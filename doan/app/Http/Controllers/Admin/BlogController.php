<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return "ban chua dang nhap!";
        }
        $blog=blog::all();
        return view('admin.blog.listblog',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Postcreate(Request $request)
    {
        
        $request->validate(
            [
                'title'=>'required|string|max:255',
                'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description'=>'required|string|max:255',
                'content'=>'required|string',
                
            ]
        );
        $data=$request->only(
            [
                'title',
                'description',
                'content'
                
            ]
        );
        if($request->hasFile('image'))
        {
            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('admin/assets/images/blogs/'), $filename);

            $data['image'] = $filename;
        }
        blog::create($data);
        return redirect()->route('blog.list')->with('success','Add thành công!');
    }
    public function Getcreate()
    {
        if(!Auth::check()){
            return "Bạn chưa đăng nhập";
        }
        return view('admin.blog.addblog');
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
    public function show(blog $blog)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = blog::findOrFail($id);
        return view('admin.blog.editblog',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $blog = blog::findOrFail($id);
        $request->validate(
            [
                'title'=>'required|string|max:255',
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description'=>'required|string|max:255',
                'content'=>'required|string',
                
            ]
        );
        $data=$request->only(
            [
                'title',
                'description',
                'content'
                
            ]
        );
        if($request->hasFile('image'))
        {
            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('admin/assets/images/blogs/'), $filename);

            $data['image'] = $filename;
        }else{
            // $blog=blog::findOrFail($id);
            $data['image'] =$blog->image;
        }

        $blog->update($data);
        return redirect()->route('blog.list')->with('success','Edit thành công!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Postdestroy($id)
    {
        blog::findOrFail($id)->delete();
        return redirect()->route('blog.list')->with('success', 'Xóa thành công!');
    }
    public function Getdestroy($id)
    {
        $blog = blog::findOrFail($id);

        return view('admin.blog.deleteblog',compact('blog'));
    }
}
