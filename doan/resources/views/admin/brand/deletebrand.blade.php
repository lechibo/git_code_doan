<form action="{{route('brand.delete',$brand->id)}}" method="post">
    @csrf
    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xoá?')" name="submit" style="color:red;">Delete</button>
</form>
<a href="{{route('brand.list')}}">quay lại listbrand</a>