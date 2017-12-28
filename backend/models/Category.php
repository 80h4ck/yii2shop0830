<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $tree 树
 * @property int $lft 左值
 * @property int $rgt 右值
 * @property int $depth 深度
 * @property string $name 名称
 * @property int $parent_id 父类ID
 * @property string $intro 简介
 */
class Category extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {

        return new MenuQuery(get_called_class());
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','parent_id'], 'required'],//lft tree那些东西是自动算的，不是外部提供的，可有可无
            [['intro'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => '树',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '深度',
            'name' => '名称',
            'parent_id' => '父类ID',
            'intro' => '简介',
        ];
    }

    //得到层级结构
    public function getNameText(){


        return str_repeat("-",$this->depth*4).$this->name;


    }
}
