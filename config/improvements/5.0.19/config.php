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
 * 5.0.19 improvement config
 */
$pluginsServicePath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'PluginsService.php';
$pluginsAdminServicePath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'Admin' . DS . 'PluginsAdminService.php';
if(is_writable($pluginsServicePath) && is_writable($pluginsAdminServicePath)) {
    $isPluginsServiceWritable = true;
} else {
    $isPluginsServiceWritable = false;
}
$pluginsServiceContent = file_get_contents($pluginsServicePath);
$pluginsAdminServiceContent = file_get_contents($pluginsAdminServicePath);
if(preg_match('/public function getCoreUpdate\(.+?\?bool \$force/', $pluginsServiceContent)
    && preg_match('/\$availableVersion = BcUtil::getVersion\(\'BaserCore\', true\)/', $pluginsAdminServiceContent)
) {
    $applied = true;
} else {
    $applied = false;
}
return [
    'title' => __d('baser_core', '最新版ダウンロード時に「Argument #3 ($force) must be of type bool, null given」エラーとなってしまう問題'),
    'detail' => '\BaserCore\Service\PluginsService、\BaserCore\Service\Admin\PluginsAdminService の改善版を適用します。',
    'hasExecute' => true,
    'executeEnabled' => $isPluginsServiceWritable,
    'warning' => (!$isPluginsServiceWritable)? __d('baser_core', '{0} と {1} に書き込み権限を付与してください。', $pluginsServicePath, $pluginsAdminServicePath) : '',
    'applied' => $applied
];
