<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\Detail;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{


    //配置一个upload方法
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    public function actionIndex()
    {
        //得到所有数据
        $articles=Article::find()->all();

        return $this->render('index',compact('articles'));
    }

    public function actionAdd(){

        //文章模型对象
        $model=new Article();

        //文章内容对象
        $detail=new Detail();

        //得到所有分类
        $cates=ArticleCategory::find()->asArray()->all();
        //转换成键值对
        $catesArr=ArrayHelper::map($cates,'id','name');

        //判断是不

        $request=\Yii::$app->request;
        if ($request->isPost){
            //文章入库
            $model->load($request->post());
            if ($model->validate()) {
                //文章保存
                $model->save();

                //文章详情入库
                if ($detail->load($request->post())) {
                    $detail->article_id=$model->id;
                    if ($detail->save()) {
                        return $this->redirect(['index']);
                    }
                }


            }




        }



        return $this->render('add', compact('model','detail','catesArr'));







    }

}
