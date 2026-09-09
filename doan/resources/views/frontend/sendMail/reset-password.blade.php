<h2>Đặt lại mật khẩu</h2>

<p>Bạn đã yêu cầu đặt lại mật khẩu.</p>

<p>
    <a href="{{ $url }}">
        Click vào đây để đặt lại mật khẩu
    </a>
</p>

<p>Link này có hiệu lực trong 30 phút.</p>

<!-- $url ở đây chính là URL đã tạo bằng
$url = URL::temporarySignedRoute(
    'password.reset',
    now()->addMinutes(30),
    [
        'id' => $user->id,
    ]
); -->