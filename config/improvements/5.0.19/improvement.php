<?php
$targetPath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'PluginsService.php';
$srcPath = __DIR__ . DS . 'src' . DS . 'Service' . DS . 'PluginsService.php';
if(!copy($srcPath, $targetPath)) {
    throw new \BaserCore\Error\BcException(__d('baser_core', "ファイルのコピーに失敗しました。手動で適用してください。\n{0} => {1}", $srcPath, $targetPath));
}
