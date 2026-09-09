<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;



class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function getForgotPass()
    {
        return view('frontend.member.forgotpass');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email không tồn tại!'
            ]);
        }

        // tạo URL reset password
        $url = URL::temporarySignedRoute(
            'user.password.reset',
            now()->addMinutes(30),
            [
                'id' => $user->id,
            ]
        );
        //  Gửi email
        Mail::to($user->email)
            ->send(new ResetPasswordMail($url));

        return back()->with(
            'success',
            'Đã gửi link đổi mật khẩu vào email!'
        );
        // return $status === Password::RESET_LINK_SENT
        //     ? back()->with('status', __($status))
        //     : back()->withErrors([
        //         'email' => __($status),
        //     ]);
    }


    public function showResetForm(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('frontend.member.newpass',compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Đổi mật khẩu thành công!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
