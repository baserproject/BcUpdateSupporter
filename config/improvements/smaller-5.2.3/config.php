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
 * smaller 5.2.3 improvement config
 */
$composerPath = ROOT . DS . 'composer.json';
if(is_writable($composerPath)) {
    $isComposerWritable = true;
} else {
    $isComposerWritable = false;
}
$content = file_get_contents($composerPath);
if(preg_match('/"firebase\/php-jwt":\s*"7\./', $content)) {
    $applied = true;
} else {
    $applied = false;
}
return [
    'title' => 'baserCMS 5.2.3 へのアップデートにて php-jwt7系が必要な問題',
    'detail' => 'baserCMS 5.2.3 へアップデート可能な composer.json を設置します。',
    'hasExecute' => true,
    'executeEnabled' => $isComposerWritable,
    'warning' => (!$isComposerWritable)? __d('baser_core', '{0} に書き込み権限を付与してください。', $composerPath) : '',
    'applied' => $applied
];
