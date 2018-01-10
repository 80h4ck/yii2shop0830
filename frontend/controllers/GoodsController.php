<?php

namespace frontend\controllers;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLists($id){


        //var_dump(\Yii::$app->controller->id."/".\Yii::$app->controller->action->id);exit;

        return $this->render('lists');

    }

}
