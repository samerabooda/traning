<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class AdminAuthController extends Controller
{

    public function login(){

        return view('admin.login');
    }
    public function postLogin(Request $request,Admin $admin){

        $remmember = $request->remmember == 1 ? true : false ;
        if (auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$remmember)){
            $admin = Admin::find(auth()->guard('admin')->user()->id);
                $admin->last_login_at = Carbon::now()->toDateTimeString();
                $admin->last_login_ip = $_SERVER['REMOTE_ADDR'];
                    $admin->save();
            session()->flash('success',__('مرحبا بك في لوحة التحكم '));
            return redirect()->route('dashboard');
        }else{
            session()->flash('success',__('عذرا يوجد خطا في البريد الالكتروني او كلمة السر '));
            return redirect('admin/login');
        }
    }

    public function forgetPassword(){

        return view('admin.forgotpassword');
    }

    public function forgetPasswordPost(Request $request){

        $admin = Admin::where('email','=',$request->email)->first();

        if (!empty($admin)){
            $token = app('auth.password.broker')->createToken($admin);

            $data = DB::table('password_resets')->insert([
               'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send( new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            session()->flash('success',__('تم الارسال بنجاح'));
            return back();
        }
        return back();
    }

    public function reset_password($token){

        $check_token = DB::table('password_resets')->where('token','=',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();

        if (!empty($check_token)){

            return view('admin.resetPassword',['data'=>$check_token]);
        }else{

            return redirect()->route('forgot-password');
        }

    }

    public function reset_password_final(Request $request,$token){

        $request->validate([
           'password'  => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = DB::table('password_resets')->where('token','=',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();

        if (!empty($check_token)) {

            $newData = Admin::where('email','=',$check_token->email)->update([
               'email' => $request->email,
               'password' => bcrypt($request->password),
            ]);
            DB::table('password_resets')->where('email','=',$request->email)->delete();
            auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],true);
            return redirect('admin');
        }
        session()->flash('success',__('تم الارسال بنجاح'));
        return redirect()->route('get-login');

    }




    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('get-login');
    }
}
