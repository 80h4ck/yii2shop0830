<?php

namespace backend\controllers;

use backend\models\Mulu;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMd5(){

        //明文 123456 密码 e6d379f633f608eca8c82e99910ce95d
        $password='123456';
        $qz="flzx3000c!32asdfw143";
        $hz=rand(1,99999);

        var_dump(md5($qz.$password.$hz));

        $hz=rand(1,99999);

        var_dump(md5($qz.$password.$hz));



    }

    public function actionIp(){


        //Ip优化 127.0.0.1  ====>

        //1.IP转数子
        var_dump(ip2long('255.255.255.253'));

        //2. 数子转IP
        var_dump(long2ip(-3));



        var_dump(\Yii::$app->security->generateRandomString(32));

    }

    public function actionMenu(){

       var_dump(Mulu::menu());


    }
}
