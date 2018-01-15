<?php

namespace frontend\controllers;

use backend\models\Goods;
use Codeception\Lib\Connector\Yii2;
use yii\redis\Connection;

class Day15Controller extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRedis(){

        //1. 设置一个值
       // $redis=\Yii::$app->redis;
        $redis=new Connection();
       // $redis->set("name",'张三');
        echo $redis->get("name");



    }

    public function actionSession(){

        \Yii::$app->session->set("name","光头");


    }

    public function actionQiang(){

        $redis=new Connection();
        //
      $good=  Goods::findOne(5);
      //把商品库存放入Redis
/*
      for ($i=1;$i<=$good->stock;$i++){

          $redis->lpush("goods:5",$i);

      }*/

        if ($redis->llen("goods:5")) {
            $good->stock-=1;
            if ($good->save()) {
                $redis->rpop("goods:5");
            }

        }

        //抽奖概率
        $rand=rand(1,100);

        if ($rand<=5) {
            //一定中状
        }




    }

    public function actionEmail(){
      $send=  \Yii::$app->mailer->compose()
            ->setFrom('ne_july@163.com')//发件箱
            ->setTo('wjx@itsource.cn') //收件箱
            ->setSubject('LBB 的第一次') //邮件标题
            //->setTextBody('JGG的女朋友到货了') //文本内容
            ->setHtmlBody('<b>WJJ </b>') //HTML内容
            ->send();

      var_dump($send);
    }

}
