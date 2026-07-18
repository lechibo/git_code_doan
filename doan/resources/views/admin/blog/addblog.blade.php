<h3>ADD BLOGS</h3>

<form action="{{route('addblog.create')}}" method="post" enctype="multipart/form-data">

    @csrf
    <label for="title">Title</label></br>
    <input type="text" id="title" name="title" placeholder="Nhập vào blog-title..."></br></br>

    <label for="">Image</label></br>
    <input type="file" name="image"></br></br>

    <label for="">Description</label></br>
    <textarea name="description"></textarea></br></br>

    <label for="">Content</label></br>
    <textarea name="content" id="demo"></textarea></br></br>

    <input type="submit" value="Add">
</form>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('demo');
</script>