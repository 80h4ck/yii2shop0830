<?php

namespace frontend\controllers;

use frontend\models\User;
use Mrgoon\AliSms\AliSms;
use yii\helpers\Json;
use yii\web\Session;

class UserController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 3,
                'maxLength' => 3
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegist()
    {

        $request=\Yii::$app->request;

        if ($request->isPost) {

          //  var_dump($request->post());
            //添加用户
            $user=new User();

            //数据绑定
            $user->load($request->post());

            //后台验证
            if ($user->validate()){
                  //保存数据
                $user->password_hash=\Yii::$app->security->generatePasswordHash($user->password);
                $user->auth_key=\Yii::$app->security->generateRandomString();
                if ($user->save(false)) {

                    //返回数据
                    return Json::encode(
                        [
                            'status'=>1,
                            'msg'=>"注册成功",
                            'data'=>null
                        ]

                    );


                }

            }

            return Json::encode( [
                'status'=>0,
                'msg'=>"注册失败",
                'data'=>$user->errors
            ]);
            var_dump($user->errors);exit;
            $user->username=$request->post('username');
            $user->password_hash=\Yii::$app->security->generatePasswordHash($request->post('password'));
            $user->mobile=$request->post('tel');

            if ($user->save()) {
                return 1;
            }else{
                var_dump($user->errors);exit;
            }

        }

        return $this->render('regist');


    }

    public function actionSms($mobile){

       //发送验证

        //1. 生成验证码 规则随机6位

        $code=rand(100000,999999);

        //2. 发送验证给手机
        //2.1 配置文件
        $config = [
            'access_key' => 'LTAIp1LvPceMANDn',//应用ID
            'access_secret' => 'OdCuRTf7owaoHRz9LVxyAy7kwLOeds',//密钥
            'sign_name' => '周大宝',//签名
        ];
        //2.2创建短信发送对象
        $aliSms=new AliSms();
        //3.3发送短信
        $response = $aliSms->sendSms($mobile, 'SMS_120405838', ['code'=> $code], $config);
        var_dump($response);
        //3. 把验证码存起来
        //  验证存session  13888888=》125445  13999999=》5456544
        \Yii::$app->session->set($mobile,$code);

        return $code;
    }

    public function actionCheck($tel){
        //验证验证码是否正确
        //1 根据手机号取对应的验证

       $code= \Yii::$app->session->get($tel);
       return $code;



    }

}
