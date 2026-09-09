<form action="{{ route('user.password.update',[
        'id' => $user->id,
        'expires' => request('expires'),
        'signature' => request('signature'),
    ]) }}" method="POST">
    @csrf

    <input type="hidden" name="id" value="{{ $user->id }}">

    <input
        type="password"
        name="password"
        placeholder="Mật khẩu mới"
        required
    >

    <input
        type="password"
        name="password_confirmation"
        placeholder="Nhập lại mật khẩu"
        required
    >

    <button type="submit">
        Đổi mật khẩu
    </button>
</form>