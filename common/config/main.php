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
            'client_id' => '438146500516-bord90m8nnet93q5lcrsqggkufhbtpdc.apps.googleusercontent.com',
            'client_secret' => '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',
            'client_refresh_token' => '1%2F%2F04wCxeBwJmcSICgYIARAAGAQSNwF-L9IrzENdMad0YgKwq2JzGOQ8RnfvlEUlFDlj03Q-fsFCKRiQPNgbSNHOTZTKzLZ9JLvj6NI',
            'grant_type' => 'refresh_token',
            'files_api' => 'https://www.googleapis.com/drive/v2/files?q=%27root%27%20in%20parents',
            'refresh_token_api' => 'https://oauth2.googleapis.com/token'
        ]
    ],
];
