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
    'title' => 'v5.0.20 を指定してアップデートできない問題',
    'detail' =>
        "v5.0.20 未満のバージョンの場合、このプラグインが有効化されていれば、v5.0.20より新しいバージョンがリリースされていたとしても強制的に v5.0.20 にアップデートします。\n" .
        "（v5.1.0 にアップデートする場合、v5.0.20 へのアップデートが必須となるため）",
    'hasExecute' => false,
    'executeEnabled' => false,
];
