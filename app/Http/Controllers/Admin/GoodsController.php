<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Goods;
use App\Http\Requests\StoreGoodsPost;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //商品分类
        $cate = Category::all();
        $cate = CreateTree($cate);

        //按商品名称搜索
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['goods_name','like',"%$name%"];
        }

        //按照商品分类
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[] = ['goods.cate_id','=',$cate_id];
        }
        //接收起始价格
        $startprice = request()->startprice;
        if($startprice){
            $where[] = ['goods.goods_price','>=',$startprice];
        }
        //接收终点价格
        $endprice = request()->endprice;
        if($endprice){
            $where[] = ['goods.goods_price','<=',$endprice];
        }

        $pageSize = config('app.pageSize');
        //DB::connection()->enableQueryLog();
        $goods = Goods::select('goods.*','cate_name','brand_name')
                        ->leftjoin('category','goods.cate_id','=','category.cate_id')
                        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                        ->where($where)
                        ->orderBy('goods_id','desc')
                        ->paginate($pageSize);
        //$logs = DB::getQueryLog();
        //dump($logs);                
       // dd($goods);
        //return view('admin.goods.index',['goods'=>$goods,'name'=>$name,'cate'=>$cate,'cate_id'=>$cate_id]);
        return view('admin.goods.index',compact('goods','name','cate','cate_id','startprice','endprice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dump(encrypt(123456));
        // dd(encrypt(123456));
        //商品分类
        $cate = Category::all();
        $cate = CreateTree($cate);
        //dd($cate);
        //商品品牌
        $brand = Brand::select('brand_id','brand_name')->get();

        return view('admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        $post = $request->except('_token');
       // dump($post);
         //文件上传
        if ($request->hasFile('goods_img')) { 
            $post['goods_img'] = upload('goods_img');
        }

        //多文件上传
        if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = Moreupload('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }

        $res = Goods::create($post);
        if($res){
            return redirect('/goods');
        }
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //商品分类
        $cate = Category::all();
        $cate = CreateTree($cate);
        //dd($cate);
        //商品品牌
        $brand = Brand::select('brand_id','brand_name')->get();

        $goods = Goods::find($id);

        return view('admin.goods.edit',['goods'=>$goods,'cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        $post = $request->except('_token');
        if ($request->hasFile('goods_img')) { 
            $post['goods_img'] = upload('goods_img');
        }

        //多文件上传
        if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = Moreupload('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }

        $res = Goods::where('goods_id',$id)->update($post);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Goods::destroy($id);
        if($res){
           echo json_encode(['code'=>'00000','msg'=>'删除成功！']) ;die;
        }
    }

    //检查名称是否存在
    public function checkName(){
        $goods_name = request()->goods_name;
        $count = Goods::where('goods_name',$goods_name)->count();
        echo $count;
    }
}
