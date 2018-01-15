<?php

namespace console\controllers;

use backend\models\Goods;
use dosamigos\qrcode\lib\Enum;
use dosamigos\qrcode\QrCode;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Delivery;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\console\Controller;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use EasyWeChat\Foundation\Application;
use yii\helpers\Url;

class OrderController extends Controller
{


    /**
     * 清除超时未支付的订单
     */
    public function actionClear()
    {
        while (true){
            //1. 找出 超时 未支付 订单 time()-创建时间>15*60  time()-15*60>创建时间

            $orders=Order::find()->where(['status'=>1])->andWhere(['<','create_time',time()-15*60])->asArray()->all();


            //1.1 把所有要取消的订单的ID提取出来
            //   var_dump(array_column($orders,'id'));
            $orderIds=array_column($orders,'id');

            //2. 把超时未支付的订单的状态改成0  0 已取消 1等待支付 2等待发货 3等待收货

            Order::updateAll(['status'=>0],['in','id',$orderIds]);

            //3. 还原库存

            foreach ($orderIds as $orderId){

                //3.1 根据每一个订单号找出订单详情
                $orderGoods= OrderDetail::find()->where(['order_info_id'=>$orderId])->all();
                //3.2 再次循环订单商品
                foreach ($orderGoods as $orderGood){

                    //3.3 还原商品库存
                //    Goods::updateAllCounters(['stock'=>$orderGood->amount],['id'=>$orderGood->goods_id]);
                    $good=Goods::findOne($orderGood->goods_id);
                    $good->stock=$good->stock+$orderGood->amount;
                    $good->save();

                }

            }

            //判断是否有超时未支付的订单
            if ($orderIds){

                echo implode(",",$orderIds)." complete ok".PHP_EOL;
            }


            sleep(5);
        }


    }
}
