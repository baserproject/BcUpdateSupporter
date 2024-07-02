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
 * 5.0.20 improvement config
 */
$composerPath = ROOT . DS . 'composer.json';
if(is_writable($composerPath)) {
    $isComposerWritable = true;
} else {
    $isComposerWritable = false;
}
$content = file_get_contents($composerPath);
if(preg_match('/"cakephp\/cakephp":\s*"5\./', $content)) {
    $applied = true;
} else {
    $applied = false;
}
return [
    'title' => 'baserCMS5.1系へのアップデートにて CakePHP5系が必要な問題',
    'detail' => 'baserCMS5.1系とともに、CakePHP5系にアップデート可能な composer.json を設置します。',
    'hasExecute' => true,
    'executeEnabled' => $isComposerWritable,
    'warning' => (!$isComposerWritable)? __d('baser_core', '{0} に書き込み権限を付与してください。', $composerPath) : '',
    'applied' => $applied
];
