
<form action="{{route('country.delete',$country->id)}}" method="post">
    @csrf
    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xoá?')" name="submit" style="color:red;">Delete</button>
</form>
<a href="{{route('country.list')}}">quay lại listcountry</a>