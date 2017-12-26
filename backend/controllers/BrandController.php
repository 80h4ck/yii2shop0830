<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;


class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //得到所有数据
        $brands = Brand::find()->all();

        return $this->render('index', compact('brands'));
    }

    public function actionAdd()
    {
        //生成模型对象
        $model = new Brand();

        $request = \Yii::$app->request;
        if ($request->isPost) {

            //绑定数据库
            $model->load($request->post());

            //验证
            if ($model->validate()) {
                //保存数据
                $model->save();
                \Yii::$app->session->setFlash("success", '添加成功');
                return $this->redirect(['index']);

            }

            /*    //得到上传图片对象
                $model->logoFile=UploadedFile::getInstance($model,'logoFile');
                //后端验证
                if ($model->validate()) {
                    //定义上传后路径
                    $path="";
                    //判断是否上传了图片
                    if ($model->logoFile) {
                        //路径
                        $path="images/brand/".uniqid().".".$model->logoFile->extension;
                        //移动图片
                        $model->logoFile->saveAs($path,false);
                    }
                   //给logo赋值
                    $model->logo=$path;
                    //保存数据
                    if ($model->save()) {
                        //提示
                        \Yii::$app->session->setFlash("success",'添加成功');
                        //跳转
                        return $this->redirect(['index']);

                    }



                }else{
                    //TODO
                    var_dump($model->errors);exit;
                }*/


        }
        //显示视图
        return $this->render('add', ['model' => $model]);

    }

    public function actionEdit($id)
    {
        //生成模型对象
        $model = Brand::findOne($id);

        $request = \Yii::$app->request;
        if ($request->isPost) {

            //绑定数据库
            $model->load($request->post());

            //验证
            if ($model->validate()) {
                //保存数据
                $model->save();
                \Yii::$app->session->setFlash("success", '添加成功');
                return $this->redirect(['index']);

            }

            /*    //得到上传图片对象
                $model->logoFile=UploadedFile::getInstance($model,'logoFile');
                //后端验证
                if ($model->validate()) {
                    //定义上传后路径
                    $path="";
                    //判断是否上传了图片
                    if ($model->logoFile) {
                        //路径
                        $path="images/brand/".uniqid().".".$model->logoFile->extension;
                        //移动图片
                        $model->logoFile->saveAs($path,false);
                    }
                   //给logo赋值
                    $model->logo=$path;
                    //保存数据
                    if ($model->save()) {
                        //提示
                        \Yii::$app->session->setFlash("success",'添加成功');
                        //跳转
                        return $this->redirect(['index']);

                    }



                }else{
                    //TODO
                    var_dump($model->errors);exit;
                }*/


        }

        //显示视图
        return $this->render('add', ['model' => $model]);

    }

    /* public function actionEdit($id)
     {
         //生成模型对象
        // $model=new Brand();
         $model=Brand::findOne($id);

         $request=\Yii::$app->request;
         if ($request->isPost){

             //绑定数据库
             $model->load($request->post());

             //得到上传图片对象
             $model->logoFile=UploadedFile::getInstance($model,'logoFile');
             //后端验证
             if ($model->validate()) {
                 //定义上传后路径
                 $path=$model->logo;
                 //判断是否上传了图片
                 if ($model->logoFile) {
                     //删除之前的图片
                     unlink($path);
                     //路径
                     $path="images/brand/".uniqid().".".$model->logoFile->extension;
                     //移动图片
                     $model->logoFile->saveAs($path,false);
                 }
                 //给logo赋值
                 $model->logo=$path;
                 //保存数据
                 if ($model->save()) {
                     //提示
                     \Yii::$app->session->setFlash("success",'添加成功');
                     //跳转
                     return $this->redirect(['index']);

                 }



             }else{
                 //TODO
                 var_dump($model->errors);exit;
             }


         }
         //显示视图
         return $this->render('add', ['model' => $model]);

     }*/

    public function actionDel($id)
    {
        if (Brand::findOne($id)->delete()) {
            \Yii::$app->session->setFlash("success", '删除成功');
            return $this->redirect(['index']);
        }

    }

    public function actionUpload()
    {

        $uploadType=\Yii::$app->params['uploadType'];

        switch ($uploadType){

            case 'local':

                //本地上传在这里
                break;

            case 'qiniu':
                //七牛云
                break;



        }

        // var_dump($_FILES);exit;

        /*
                //得到上传文件的实例对象
                $file=UploadedFile::getInstanceByName("file");
                if ($file) {
                  //路径
                    $path="images/brand/".time().".".$file->extension;
                    //移动图片
                    if ($file->saveAs($path,false)) {
                        // {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}

                        $result=[
                            'code'=>0,
                            'url'=>"/".$path,
                            'attachment'=>$path

                        ];
                        return json_encode($result);
                    }

                }*/

        //上传到七牛云

        $config = [
            'accessKey' => 'EAd29Qrh05q78_cZhajAWcbB1wYCBLyHLqkanjOG',//AK
            'secretKey' => '_R5o3ZZpPJvz8bNGBWO9YWSaNbxIhpsedbiUtHjW',//SK
            'domain' => 'http://p1ht4b07w.bkt.clouddn.com',//临时域名
            'bucket' => 'php0830',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
        ];

//var_dump($_FILES);exit;


        $qiniu = new Qiniu($config);//实例化对象
//var_dump($qiniu);exit;
        $key = time();//上传后的文件名  多文件上传有坑
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址

        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        return json_encode($result);


    }

}
