<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */
return [
    'BcApp' => [
        /**
         * 管理画面メニュー
         */
        'adminNavigation' => [
            'Systems' => [
                'BcUpdateSupporter' => [
                    'title' => __d('baser_core', 'アップデートサポーター'),
                    'type' => 'system',
                    'url' => ['prefix' => 'Admin', 'plugin' => 'BcUpdateSupporter', 'controller' => 'Support', 'action' => 'index'],
                    'menus' => [
                        'Support' => [
                            'title' => __d('baser_core', 'アップデート時の問題'),
                            'url' => ['prefix' => 'Admin', 'plugin' => 'BcUpdateSupporter', 'controller' => 'Support', 'action' => 'index'],
                        ],
                        'Migration' => [
                            'title' => __d('baser_core', 'マイグレーション実行'),
                            'url' => ['prefix' => 'Admin', 'plugin' => 'BcUpdateSupporter', 'controller' => 'Support', 'action' => 'migration'],
                        ],
                        'Script' => [
                            'title' => __d('baser_core', 'スクリプト実行'),
                            'url' => ['prefix' => 'Admin', 'plugin' => 'BcUpdateSupporter', 'controller' => 'Support', 'action' => 'script'],
                        ]
                    ]
                ]
            ]
        ]
    ]
];
