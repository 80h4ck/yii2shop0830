<?php

namespace frontend\controllers;

use backend\models\Goods;
use dosamigos\qrcode\lib\Enum;
use dosamigos\qrcode\QrCode;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Delivery;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use EasyWeChat\Foundation\Application;
use yii\helpers\Url;

class OrderController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            //回到登录页面

            return $this->redirect(['user/login', 'back' => 'order/index']);

        }

        //1. 取出当前用户的所有地址
        $userId = \Yii::$app->user->id;
        $addresses = Address::find()->where(['user_id' => $userId])->all();

        //2. 取出所有送货方式
        $deliverys = Delivery::find()->all();



        //3. 取出购物车中所有商品
        //3.1
        $cart = Cart::find()->where(['user_id' => $userId])->asArray()->all();
       //3.2 取出所有商品Id
        $cartGoods = ArrayHelper::map($cart, 'goods_id', 'amount');
        //  var_dump($cartGoods);exit;
        //提取所有商品Id
        $goodIds = array_column($cart, 'goods_id');


        // var_dump($goodIds);exit;
        //3.3 通过商品Id把所有商品取出来
        $goods = Goods::find()->where(['in', 'id', $goodIds])->asArray()->all();

        //定义一个总金额
        $totalMoney=0;
        //默认的运费
        $yunFei=Delivery::findOne(['status'=>1])->price;
        foreach ($goods as $k => $good) {
            //追加购物车每个商品数量
            $goods[$k]['num'] = $cartGoods[$good['id']];
            //  $goods[1]['num']=$cart[$good['id']];
            //算总钱  商品数量*商品价格
            $totalMoney+=$good['shop_price']*$cartGoods[$good['id']];
        }

        //应付总额
        $allMoney=$totalMoney+$yunFei;
       // var_dump($goods);exit;

        //判断是不是POST提交
        $request=\Yii::$app->request;
        if ($request->isPost) {


            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();//开启事务

            try {
                //取出送货地址
                $address=Address::findOne($request->post('address_id'));
                //取出送货方式
                $delivery=Delivery::findOne($request->post('delivery'));
                //取出支付方式
                $payType=ArrayHelper::map(\Yii::$app->params['payType'],'id','name');

                //1. 实例化订单模型对象
                $order=new Order();
                $order->user_id=$userId;
                //地址赋值
                $order->name=$address->name;
                $order->province=$address->province;
                $order->city=$address->city;
                $order->area=$address->county;
                $order->detail_address=$address->address;
                $order->tel=$address->mobile;
                //送货方式赋值
                $order->delivery_id=$delivery->id;
                $order->delivery_name=$delivery->name;
                $order->delivery_price=$delivery->price;
                //支付方式
                $order->payment_id=$request->post('pay');
                $order->payment_name=$payType[$order->payment_id];//取出支付名称

                $order->price=$totalMoney+$delivery->price; //订单总价 商品总价+当前运费
                $order->status=1;//0 取消 1 等待支付 2 等待发货 3 等待收货

                //订单号生成
                $order->trade_no=date("ymdHis").rand(1000,9999);
                $order->create_time=time();

                //保存订单
                $order->save();

                ///订单详情表入库 订单商品入库

                foreach ($goods as $good){

                    //取出当前商品库存
                    $stock= Goods::findOne($good['id'])->stock;

                    //如果库存不够就退出
                    if ($good['num']>$stock){

                        //exit('库存不足');
                        throw  new Exception("库存不足");

                    }


                    //创建订单详情对象
                    $orderDetail=new OrderDetail();
                    $orderDetail->order_info_id=$order->id;
                    $orderDetail->goods_id=$good['id'];
                    $orderDetail->amount=$good['num'];
                    $orderDetail->goods_name=$good['name'];
                    $orderDetail->logo=$good['logo'];
                    $orderDetail->price=$good['shop_price'];
                    $orderDetail->total_price=$good['shop_price']*$good['num'];
                    //保存
                    if ($orderDetail->save()) {
                        //-少库存   Goods::updateAllCounters(['修改的字段'=>-数量],['id'=>商品Id]);
                        Goods::updateAllCounters(['stock'=>-$good['num']],['id'=>$good['id']]);
                        /*  $g= Goods::findOne($good['id']);
                          $g->stock=$g->stock-$good['num'];
                          $g->save();*/

                    }


                }

                //清空购物车
                Cart::deleteAll(['user_id'=>$userId]);

                $transaction->commit();//提交事务

            } catch(Exception $e) {

                $transaction->rollBack();//回滚

                exit($e->getMessage());//错误信息

            }


        }



        return $this->render('index', compact('addresses', 'deliverys','goods','totalMoney','yunFei','allMoney'));
    }


    public function actionWxPay($id){


        //把订单查出来
        $goodsOrder=Order::findOne($id);



        //easywechat全局对象
        $app = new Application(\Yii::$app->params['easyWechat']);
        //支付对象
        $payment = $app->payment;



        //放订单详情信息

        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP... 支付类型:NATIVE 原生扫码支付
            'body'             => '京西订单 ',//订单标题
            'detail'           => '京西订单 好多商品',//详情
            'out_trade_no'     => $goodsOrder->trade_no,//订单编号
            'total_fee'        => $goodsOrder->price*100, // 单位：分 支付金额
            'notify_url'       => Url::to(['order/notify'],true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            //'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        //创建订单
        $order = new \EasyWeChat\Payment\Order($attributes);

        //统一下单
        $result = $payment->prepare($order);
       // var_dump($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
           // $prepayId = $result->prepay_id;
            //echo  $result->code_url;
            //二维码生成
            return QrCode::png($result->code_url,false,Enum::QR_ECLEVEL_H,6);
        }else{

            var_dump($result);
        }


    }

    public function actionOk(){


        return $this->render('ok');
    }

    public function actionNotify(){


        //easywechat全局对象
        $app = new Application(\Yii::$app->params['easyWechat']);

        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
           // $order = 查询订单($notify->out_trade_no);
            $order=Order::findOne(['trade_no'=>$notify->out_trade_no]);

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!=1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                //$order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 2;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;

    }
}
