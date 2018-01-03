<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLogin(){

        //判断用户是否登录

        if (!\Yii::$app->user->isGuest) {

            return $this->redirect(['index']);
        }

        //实例化表单模型对象
        $model=new LoginForm();

         //
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());

            //后台验证
            if ($model->validate()) {

               // var_dump($model->rememberMe);exit;
                //1.判断用户名是否存在
                $admin=Admin::findOne(['username'=>$model->username]);

                if ($admin) {
                    //2.用户存在,验证密码是否正确
                    if (\Yii::$app->security->validatePassword($model->password,$admin->password_hash)) {
                        //3.密码正确,用user组件登录
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);

                        //4.修改登录IP和时间
                        $admin->login_at=time();
                        $admin->login_ip=ip2long(\Yii::$app->request->userIP);
                        $admin->save();
                        //提示
                        \Yii::$app->session->setFlash("success",'登录成功');

                       //跳转
                        return $this->redirect(['index']);


                    }else{

                        //用户不存在
                        $model->addError('password','密码不正确');
                    }


                }else{
                    //用户不存在
                    $model->addError('username','用户名不存在');


                }










            }



        }


        //显示视图
        return $this->render('login',compact('model'));





    }

    public function actionAdd(){

        //创建模型对象
        $admin=new Admin();
        $admin->username="jgg";
        $admin->password_hash=\Yii::$app->security->generatePasswordHash('123456');
        $admin->auth_key=\Yii::$app->security->generateRandomString();
        $admin->login_ip=ip2long(\Yii::$app->request->userIP);

        $admin->save();


        //实例化组件
        $auth=\Yii::$app->authManager;

        //找到角角
        $role=$auth->getRole("学习喂员");

        //给用户分组
        $auth->assign($role,$admin->id);

        //解除用户和组（角色）的关系
        //$auth->revoke(角色对象，用户ID);




    }

    public function actionLogout(){

        if (\Yii::$app->user->logout()) {
            return $this->redirect(['login']);
        }


    }

    public function actionRbac(){


        var_dump(\Yii::$app->user->can('brand/add'));



    }

}
