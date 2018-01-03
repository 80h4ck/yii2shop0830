<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mulu".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $url 路由
 * @property string $icon 图标
 * @property int $parent_id 父亲Id
 */
class Mulu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mulu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'url', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'url' => '路由',
            'icon' => '图标',
            'parent_id' => '父亲Id',
        ];
    }


    public static function menu()
    {
        $menu1 = [
            [
                'label' => '商品管理',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    ['label' => '添加商品', 'icon' => 'fighter-jet', 'url' => ['/goods/add']],
                    ['label' => '商品列表', 'icon' => 'dashboard', 'url' => ['/goods/index'],],

                ],
            ],
            [
                'label' => '商品管理',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    ['label' => '添加商品', 'icon' => 'fighter-jet', 'url' => ['/goods/add']],
                    ['label' => '商品列表', 'icon' => 'dashboard', 'url' => ['/goods/index'],],
                ],
            ],

            //  \backend\models\Mulu::menu(),

        ];
        $newMenus = [];

        //只找出一一级分类
        $menus = self::find()->where(['parent_id' => 0])->all();

        //循环一级分类
        foreach ($menus as $menu) {

            //分别赋值
            $newMenu = [
                'label' => $menu->name,
                'icon' => $menu->icon,
                'url' => '#',
            ];

            //循环当前分类的二级分类
            foreach (self::find()->where(['parent_id' => $menu->id])->all() as $v) {


                //给每个二级分类赋值
                $newMenu['items'][] = [
                    'label' => $v->name,
                    'icon' => $v->icon,
                    'url' => [$v->url]
                ];

            }


            //把一级分类追加到数组中
            $newMenus[]=$newMenu;

        }

        //返回
        return $newMenus;
       // return self::find()->all();


    }
}
