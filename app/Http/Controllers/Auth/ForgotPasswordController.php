<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {

        return view('web.auth.password.email');
    }

    public function postEmail(Request $request)
    {
        $email = $request->email;

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // FacadesMail::send('web.auth.password.verify', ['token' => $token], function ($message) use ($request) {
        //     $message->from('email@example.com');
        //     $message->to($request->email);
        //     $message->subject('Reset Password Notification');
        // });
        $user = DB::table('users')
            ->where('email', $email)
            ->first();
            // dd($user);
            if (!$user) {
                abort(404);
            } //end if
        // return back()->with('message', 'We have e-mailed your password reset link!');
        $compacts = [
            'siteTitle' => " đặt lại mật khẩu ",
            'user' => $user
        ];
        return view('web.auth.password.confirm_pass',$compacts);
    }
    public function update(int $id, Request $request)
    {
        $password = Hash::make($request->password);
        DB::table('users')->where('id', $id)->update(['password' => $password]);

        return redirect()->route('login')->with('success', 'Thành công');
    }
}
