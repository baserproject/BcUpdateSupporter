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
$srcPluginsServicePath = __DIR__ . DS . 'src' . DS . 'Service' . DS . 'PluginsService.php';
$srcPluginsAdminServicePath = __DIR__ . DS . 'src' . DS . 'Service' . DS . 'Admin' . DS . 'PluginsAdminService.php';
$targetPluginsServicePath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'PluginsService.php';
$targetPluginsAdminServicePath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'Admin' . DS . 'PluginsAdminService.php';
if(!copy($srcPluginsServicePath, $targetPluginsServicePath)
    || !copy($srcPluginsAdminServicePath, $targetPluginsAdminServicePath)
) {
    throw new \BaserCore\Error\BcException(__d('baser_core',
        "ファイルのコピーに失敗しました。手動で適用してください。" .
        "\n{0} => {1}" .
        "\n{2} => {3}",
        $srcPluginsServicePath,
        $targetPluginsServicePath,
        $srcPluginsAdminServicePath,
        $targetPluginsAdminServicePath
    ));
}
