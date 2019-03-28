<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;
use App\Tools\alipay\wappay\service\AlipayTradeService;


class AlipayController extends Controller
{
    public function alipay()
    {
        header("Content-type: text/html; charset=utf-8");
        $config=config("config");
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = "13132443213331";

        //订单名称，必填
        $subject = "我是你爸爸胡的邮件";

        //付款金额，必填
        $total_amount ="100";

        //商品描述，可空
        $body = null;

        //超时时间
        $timeout_express="1m";

        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return ;
    }
    public function notify()
    {
        echo 1;
    }
    public function return()
    {
        return view("index.paysuccess");
    }
}