<?php

namespace backend\controllers;

use backend\models\Category;
use yii\helpers\Json;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd(){
        //创建一个分类模型对象
        $model=new Category();
        //找出所有分类
        $cates=Category::find()->asArray()->all();
        $cates[]=['id'=>0,'name'=>'一级目录','parent_id'=>0];

//        var_dump(Json::encode($cates));exit;
        $cates=Json::encode($cates);

        $request=\Yii::$app->request;
        if ($request->isPost) {
            //数据绑定
            $model->load($request->post());

            //后端验证
            if ($model->validate()) {

                if ($model->parent_id==0){
                    //1. parent_id=0 创建一级分类
                    //$cate=new Category(['name'=>'家电']);
                    // $cate->makeRoot();
                     $model->makeRoot();

                       \Yii::$app->session->setFlash("success","添加一级分类".$model->name."成功");


                }else{
                    //2. 追加到对应的父类
                    //2.1. 找到父节点
                    $cateParent=Category::findOne($model->parent_id);

                    //2.2.创建一个新节点
                   /* $cate=new Category();
                    $cate->name='电冰箱';
                    $cate->parent_id=$cateParent->id;*/
                    //2.3. 把新节点加入到父节点
                    $model->prependTo($cateParent);

                    \Yii::$app->session->setFlash("success","把".$model->name."添加到".$cateParent->name."成功");

                }

                //刷新
                return $this->refresh();


            }


        }

        return $this->render('add', ['model' => $model,'cates'=>$cates]);



    }

    public function actionTest(){

        //创建一个一级分类 家电
        //$cate=new Category(['name'=>'家电']);
       // $cate->makeRoot();



        //添加一个子节点
        //1. 找到父节点
        $cateParent=Category::findOne(1);

        //2.创建一个新节点
        $cate=new Category();
        $cate->name='电冰箱';
        $cate->parent_id=$cateParent->id;
        //3. 把新节点加入到父节点
        $cate->prependTo($cateParent);

        //打印错误
        var_dump($cate->errors);

    }

}
