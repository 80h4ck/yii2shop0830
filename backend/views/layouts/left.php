<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>欢迎<?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
       <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
               'items' => \backend\models\Mulu::menu(),
               /* 'items' => [
                    ['label' => '0830后台菜单', 'options' => ['class' => 'header']],
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

                ],*/
            ]
        ) ?>

    </section>

</aside>
