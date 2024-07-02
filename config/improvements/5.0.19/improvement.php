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
 * 5.0.19 improvement
 */
$targetPath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'PluginsService.php';
$srcPath = __DIR__ . DS . 'src' . DS . 'Service' . DS . 'PluginsService.php';
if(!copy($srcPath, $targetPath)) {
    throw new \BaserCore\Error\BcException(__d('baser_core', "ファイルのコピーに失敗しました。手動で適用してください。\n{0} => {1}", $srcPath, $targetPath));
}
