<?php

namespace App\Http\Controllers\Index;

use App\Model\Car;
use App\Model\Category;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected static $arrCate;
    /*
     * @微商城前台Index
     * */
    public function Index()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        return view("index.index",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表加条件
     * */
    public function IndexShopId($id)
    {
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        $this->get($id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }

    /*
     * @商品列表
     * */
    public function IndexShop()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表ajax
     * */
    public function IndexShopAjax(Request $request)
    {
        $cate_id=$request->cate_id;
        //print_r($cate);die;
        $this->get($cate_id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表is_new
     * */
    public function IsNew()
    {
        $data=DB::table("goods")->where("is_new","=","1")->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表price
     * */
    public function Price(Request $request)
    {

        $type=$request->type;
        if($type==1){
            $data=DB::table("goods")->orderBy("self_price","desc")->get();
        }else{
            $data=DB::table("goods")->orderBy("self_price","asc")->get();
        }
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表where
     * */
    public function data(Request $request)
    {

        $type=$request->data;
        if(!empty($type)){
            $data=DB::table("goods")->where("goods_name","like","%$type%")->get();
        }else{
            $data=DB::table("goods")->get();
        }
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     *
     * */
    public function get($id)
    {
        $arrIds=DB::table("category")->select("cate_id")->where("p_id",$id)->get();
        //print_r($arrIds);die;
        if(count($arrIds)!=0){
            foreach($arrIds as $k=>$v){
                $cateId=$v->cate_id;
                $Ids=$this->get($cateId);
                //print_r($Ids);die;
                self::$arrCate[]=$Ids;
            }


        }
        if(count($arrIds)==0){
            return $id;
        }
    }
    /*
     * @商品购物车
     * */
    public function IndexShopCar()
    {
        $goods_model=new Goods();
        $date=$goods_model->get();
        $carmodel=new Car();
        $data=$carmodel->join("goods","goods.goods_id",'=',"car.goods_id")->get();
         //print_r($data);die;
        return view("index.indexshopcar",["data"=>$data],['date'=>$date]);
    }
    /*
     * @删除商品
     * */
    public function Del(Request $request)
    {
        $car_id=$request->car_id;
        $model=new Car();
        $res=$model->where("car_id","=",$car_id)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /*
     * @我的潮购
     * */
    public function IndexUser()
    {
        $usermodel=new User();
        $data=$usermodel->where('user_id','=',session('user_id'))->first();
        return view("index.indexuser",['data'=>$data]);
    }
    /*
     * @商品详情页
     * */
    public function IndexContent($id)
    {
        $model=new Goods();
        $data=$model->where("goods_id",'=',$id)->get();
        return view("index.shopcontent",['data'=>$data]);
    }
    /*
     * @加入购物车
     * */
    public function AddCar(Request $request)
    {
        $goods_id=$request->goods_id;
        //echo $goods_id;die;
        $carmodel=new Car();
        $arr=$carmodel->where("goods_id",'=',$goods_id)->first();
        if(empty($arr)){
            $carmodel->user_id=session('user_id');
            $carmodel->goods_id=$goods_id;
            $carmodel->buy_num=1;
            $res=$carmodel->save();
            if($res){
                echo json_encode(['font'=>'添加成功','code'=>1]);
            }else{
                echo json_encode(['font'=>'添加失败','code'=>2]);
            }
        }else{
            $data=[
              "buy_num"=>$arr["buy_num"]+1,
            ];
            $res=DB::table("car")->where("goods_id","=",$goods_id)->update($data);
            if($res){
                echo json_encode(['font'=>'添加成功','code'=>1]);
            }else{
                echo json_encode(['font'=>'添加失败','code'=>2]);
            }
        }
    }
    /*
     * @加号点击
     * */
    public function DeAdd(Request $request)
    {
        $data=[
            "buy_num"=>$request->buy_num,
        ];
        $res=DB::table("car")->where("car_id","=",$request->car_id)->update($data);
        if($res){
            echo "成功";
        }else{
            echo "失败";
        }
    }
    /*
     * @批量删除
     * */
    public function paydel(Request $request)
    {
        $car_id=rtrim($request->car_id,',');
        $car_id=explode(',',$car_id);
        foreach($car_id as $v){
            $model=new Car();
            $res=$model->where("car_id","=",$v)->delete();
            if(!$res){
                echo "删除失败";die;
            }
        }
    }
    /*
     * @密码修改
     * */
    public function loginpwd($id)
    {
        $fid=substr($id,0,3);
        $did=substr($id,-3);
        $id=$fid.'*****'.$did;
       return  view("index.loginpwd",['tel'=>$id]);
    }
    /*
     * @密码修改执行
     * */
    public function loginpwddo(Request $request)
    {
        $model=new User();
        $arr=$model->where('user_id','=',session("user_id"))->first();
        $oldpwd=$request->oldpwd;
        if($oldpwd!=decrypt($arr['user_pwd'])){
            echo json_encode(['font'=>"原密码错误",'code'=>2]);
        }else{
            $user=User::find(session('user_id'));
            $user->user_pwd=encrypt($request->newpwd);
            $res=$user->save();
            if($res){
                echo json_encode(['font'=>"修改成功",'code'=>1]);
            }else{
                echo json_encode(['font'=>"修改失败",'code'=>2]);
            }
        }

    }
    /*
     * @修改昵称
     * */
    public function updname()
    {
        return view("index.updname");
    }
    /*
     * @昵称修改执行
     * */
    public function updnamedo(Request $request)
    {
            $user=User::find(session('user_id'));
            $user->user_name=$request->name;
            $res=$user->save();
            if($res){
                echo json_encode(['font'=>"修改成功",'code'=>1]);
            }else{
                echo json_encode(['font'=>"修改失败",'code'=>2]);
            }
    }
    /*
     * @设置
     *
     * */
    public function set()
    {
        return view("index.set");
    }
    /*
         * @安全设置
         *
         * */
    public function safeset()
    {
        return view("index.safeset");
    }
}
