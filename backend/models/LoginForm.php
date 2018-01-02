<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/2
 * Time: 10:30
 * Company：源码时代重庆校区
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['rememberMe'],'safe']

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'rememberMe'=>'记住我'
        ];
    }

}