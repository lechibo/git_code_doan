
<form action="{{route('blog.delete',$blog->id)}}" method="post">
    @csrf
    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xoá this blog?')" name="submit" style="color:red;">Delete</button>
</form>
<a href="{{route('blog.list')}}">quay lại listcountry</a>