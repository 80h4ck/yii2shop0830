<?php
return [
    'language'=>'zh-CN',//语言
    'timeZone'=>'PRC',//时区
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        'mailer' => [
              'class' => 'yii\swiftmailer\Mailer',
              'transport' => [
                  'class' => 'Swift_SmtpTransport',
                  'host' => 'smtp.163.com',//邮箱的smtp服务器地址
                  'username' => 'ne_july@163.com',
                  'password' => 'php0830',
                  'port' => '25',
                  'encryption' => 'tls',
              ],
            'useFileTransport' => false,
          ],
    ],
];
