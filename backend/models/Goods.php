<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name 商品名称
 * @property string $sn 货号
 * @property string $logo
 * @property string $category_id 商品分类
 * @property string $brand_id 品牌分类
 * @property string $market_price 市场价格
 * @property string $shop_price 商品价格
 * @property string $stock 库存
 * @property int $status 1正常 0回收站
 * @property string $sort 排序
 * @property string $create_at
 */
class Goods extends \yii\db\ActiveRecord
{

    public $imgFiles;//用来显示多图
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT=>['create_at']
                ]
            ]

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'logo', 'category_id', 'brand_id', 'market_price', 'shop_price', 'stock','status','sort'], 'required'],
            [['market_price', 'shop_price'], 'number'],
            [['sn'],'unique'],
            [['imgFiles'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'logo' => 'Logo',
            'category_id' => '商品分类',
            'brand_id' => '品牌分类',
            'market_price' => '市场价格',
            'shop_price' => '商品价格',
            'stock' => '库存',
            'status' => '1正常 0回收站',
            'sort' => '排序',
            'create_at' => 'Create At',
        ];
    }
    //得到商品详情 1对1
    public function getIntro(){

        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);

    }

    //得到商品对应的所有图片  1对多

    public function getImages(){

        return $this->hasMany(GoodsGallery::className(),['goods_id'=>'id']);


    }
}
