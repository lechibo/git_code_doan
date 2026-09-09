<form action="{{ route('user.password.email') }}" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Nhập email của bạn">

    @error('email')
        <div>{{ $message }}</div>
    @enderror

    <button type="submit">
        Gửi link đặt lại mật khẩu
    </button>
</form>