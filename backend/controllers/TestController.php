<?php

namespace backend\controllers;

use backend\models\Mulu;
use Mrgoon\AliSms\AliSms;

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

    public function actionSms(){


        $config = [
            'access_key' => 'LTAIp1LvPceMANDn',
            'access_secret' => 'OdCuRTf7owaoHRz9LVxyAy7kwLOeds',
            'sign_name' => '周大宝',
        ];
        $sms=new AliSms();
        $response = $sms->sendSms('17623780429', 'SMS_120405838', ['code'=> '123456'], $config);

        var_dump($response);

    }
}
