<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function index(){
       // dd(encrypt(123456));
    	return view('admin.login');
    }

    public function logindo(Request $request){
    	$post = $request->except('_token');
    	
    	$admin = Admin::where('admin_name',$post['admin_name'])->first();
    	if(!$admin){
    		return redirect('/login')->with('msg','用户名或者密码错误');
    	}

    	if(decrypt($admin->pwd)!=$post['password']){
    		return redirect('/login')->with('msg','用户名或者密码错误');
    	}

    	//七天免登录
    	if(isset($post['isremember'])){
    		Cookie::queue('admin', serialize($admin), 60*24*7);
    	}

    	session(['admin'=>$admin]);

    	return redirect('/goods');
    }

    public function setcookie(){
    	//三种设置cookie的方式
   		//return response('欢迎来到 Laravel 学院')->cookie( 'name', '乐柠', 1);
   		//Cookie::queue(Cookie::make('name', '沙河地铁', 1));
   		//Cookie::queue('name', '绿萝', 1);
   		Cookie::queue('name', 'china', 1);
    }
    public function getcookie(){
    	//两种获取cookie
    	//echo request()->cookie('name');
    	echo Cookie::get('name');
    }
    //退出
    public function logout(){
    	
    	request()->session()->flush();
    	return redirect('/login');
    }

}
