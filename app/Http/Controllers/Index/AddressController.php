<?php

namespace App\Http\Controllers\Index;

use App\Model\Area;
use App\Model\Car;
use App\Model\Category;
use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Address;
class AddressController extends Controller
{
    /*
    * @地址管理
    * */
    public function Address()
    {
        $addressmodel=new Address();
        $data=$addressmodel->where(["user_id"=>session('user_id'),"address_status"=>1])->get();
        return view("address.address",['data'=>$data]);
    }
    /*
    * @订单管理
    * */
    public function payment(Request $request)
    {
        $goods_id=rtrim($request->goods_id,',');
        session(['goods_id'=>$goods_id]);
        $cartmodel=new Car();
        $goodsmodel=new Goods();
        $data=$goodsmodel
            ->join('car','car.goods_id','=','goods.goods_id')
            ->where(['user_id'=>session('user_id')])
            ->get();
        $priceNum=0;
        foreach ($data as $k=>$v){
            $priceNum+=$v['self_price']*$v['buy_num'];
        }
         //dump($priceNum);die;
        //return view('payment',['data'=>$data],['priceNum'=>$priceNum]);

        return view("shop.payment",['goodsInfo'=>$data],['priceNum'=>$priceNum]);
    }
    /*
    * @收件人管理
    * */
    public function witeaddr()
    {
        return view("address.witeaddr");
    }
    /*
    * @收件人添加
    * */
    public function addressadd(Request $request)
    {
        $addressmodel=new Address();
        //dd($addressmodel);die;
        $addressmodel->address_name=$request->address_name;
        $addressmodel->address_tel=$request->address_tel;
        $addressmodel->address_desc=$request->address_desc;
        if($request->address_default==1){
            Address::where('user_id',session('user_id'))
                ->update(['address_default' => 2]);
        }
        $addressmodel->address_default=$request->address_default;
        $addressmodel->user_id=session('user_id');
        $addressmodel->address_mail=$request->address_mail;
        $res=$addressmodel->save();
        if($res){
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'添加失败','code'=>2]);
        }
    }
    /*
     * @content 设置默认收货地址
     */
    public function addstatus(Request $request)
    {
        $address_id=$request->address_id;
        //echo $address_id;die;
        $addressmodel=new Address();
        $find=$addressmodel->where(['address_id'=>$address_id,'user_id'=>session("user_id")])->first();
        $find->address_default=1;
        $res=$find->save();
        if($res){
            Address::where('user_id',session('user_id'))
                ->where('address_id','!=',$address_id)
                ->update(['address_default' => 2]);
            echo 1;
        }else{
            echo 2;
        }
    }
    /*
    * @content 删除地址
    */
    public function adddel(Request $request)
    {
        $addressmodel=new Address();
        $where=[
            'address_id'=>$request->address_id,
            'user_id'=>session('user_id')
        ];
        $arr=$addressmodel->where($where)->first();
        $arr->address_status=2;
        $res=$arr->save();
        if($res){
            echo json_encode(['font'=>"删除成功",'code'=>1]);exit;
        }else{
            echo json_encode(['font'=>"删除失败",'code'=>2]);exit;
        }
    }
    /*
     * @content编辑地址
     */
    public function addedit($id)
    {
        $arr=Address::where(['address_id'=>$id])->first();
        if($arr==''){
            return redirect('address');
        }
        return view('address.edit',['arr'=>$arr]);
    }
    /*
     * @content 编辑执行
     */
    public function addeditdo(Request $request)
    {
//        $data=$request->all();
//        print_r($data);die;
        $addressmodel=Address::find($request->address_id);
        //print_r($addressmodel);die;
        $addressmodel->address_name=$request->address_name;
        $addressmodel->address_tel=$request->address_tel;
        $addressmodel->address_desc=$request->address_desc;
        if($request->address_default==1){
            Address::where('user_id',session('user_id'))
                ->where('address_id','!=',$request->address_id)
                ->update(['address_default' => 2]);
        }
        $addressmodel->address_default=$request->address_default;
        $addressmodel->address_mail=$request->address_mail;
        $res=$addressmodel->save();
        if($res){
            echo json_encode(['font'=>'修改成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'修改失败','code'=>2]);
        }
    }
}
