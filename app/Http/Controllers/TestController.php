<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
    	echo "我是首页";
    }

    public function add(){
    	$post = request()->post();
    	dump($post);
    	return view('add');
    }
    public function adddo(){
    	//接受所有值
    	//$post = request()->all();
    	//$post = request()->input();
    	$post = request()->post();
    	//dd($post);
    	dd($post);


    	//只接受一个name值
    	//$name = $request->name;
    	//$name = $request->post('name');
    	// $name = $request->input('name');
    	// dd($name);


    	//排除接收****
    	$data = $request->except(['_token','pwd']);
    	dump($data);
    	//只接受****
    	$data = $request->only(['_token','pwd']);
    	dd($data);
    }


    public function goods($id,$name){
    	echo $id.'-'.$name;
    }
    public function show($id=0){
    	echo $id;
    }
    public function detail($id,$name=null){
    	echo $id.'-'.$name;
    }

}
