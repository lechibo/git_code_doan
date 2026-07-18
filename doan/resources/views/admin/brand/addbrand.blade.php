<h3>ADD BRAND</h3>
<form action="{{route('addbrand.create')}}" method="post">
    @csrf
    <input type="text" name="name" id="" placeholder="Nhập vào tên Brand...">
    <input type="submit" name="submit" value="Add">
</form>