<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'googleDrive' => [
            'class' => 'common\components\googleDrive',
            'client_id' => 'YOUR CLIENT ID',
            'client_secret' => 'YOUR CLIENT SECRET',
            'client_refresh_token' => 'YOUR CLIENT REFRESH TOKEN',
            'grant_type' => 'refresh_token',
            'files_api' => 'https://www.googleapis.com/drive/v2/files?q=%27root%27%20in%20parents',
            'refresh_token_api' => 'https://oauth2.googleapis.com/token'
        ]
    ],
];
