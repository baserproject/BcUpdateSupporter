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
 * 5.1.1 improvement config
 */
$composerPath = ROOT . DS . 'composer.json';
if(is_writable($composerPath)) {
    $isComposerWritable = true;
} else {
    $isComposerWritable = false;
}
$content = file_get_contents($composerPath);
if(preg_match('/"mobiledetect\/mobiledetectlib":\s*"\^3\./', $content)) {
    $applied = true;
} else {
    $applied = false;
}
return [
    'title' => 'baserCMS 5.1.1 へのアップデート版が取得できない問題',
    'detail' => 'baserCMS 5.1.1 へアップデート可能な composer.json を設置します。',
    'hasExecute' => true,
    'executeEnabled' => $isComposerWritable,
    'warning' => (!$isComposerWritable)? __d('baser_core', '{0} に書き込み権限を付与してください。', $composerPath) : '',
    'applied' => $applied
];
