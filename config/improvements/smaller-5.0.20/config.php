<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */

/**
 * smaller 5.0.20 improvement config
 */
return [
    'title' => 'v5.0系の最新版にアップデートできない問題',
    'detail' =>
        "v5.0.20 未満のバージョンの場合、v5.1系がリリースされていると、v5.0系の最新版にアップデートできない問題があります。" . 
        "このプラグインが有効化されていれば、v5.1系がリリースされていたとしても強制的に v5.0系の最新版にアップデートします。\n" .
        "（v5.1系 にアップデートする場合、v5.0.20 以上のバージョンへのアップデートが必須となるため）",
    'hasExecute' => false,
    'executeEnabled' => false,
];
