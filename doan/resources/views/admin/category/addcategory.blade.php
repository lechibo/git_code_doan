<h3>ADD CATEGORY</h3>
<form action="{{route('addcategory.create')}}" method="post">
    @csrf
    <input type="text" name="name" id="" placeholder="Nhập vào tên Category...">
    <input type="submit" name="submit" value="Add">
</form>