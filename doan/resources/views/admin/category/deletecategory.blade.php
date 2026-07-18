<form action="{{route('category.delete',$category->id)}}" method="post">
    @csrf
    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xoá?')" name="submit" style="color:red;">Delete</button>
</form>
<a href="{{route('category.list')}}">quay lại listcategory</a>