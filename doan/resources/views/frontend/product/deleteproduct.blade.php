
<form action="{{ route('account.deleteproduct',$product->id) }}" method="POST">
    @csrf

    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
        Delete
    </button>
</form>