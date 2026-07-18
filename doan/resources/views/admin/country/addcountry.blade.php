
<h3>ADD COUNTRY</h3>
<form action="{{route('addcountry.create')}}" method="post">
    @csrf
    <input type="text" name="name" id="" placeholder="Nhập vào tên Country...">
    <input type="submit" name="submit" value="Add">
</form>