<?php
$pluginsServicePath = \Cake\Core\Plugin::path('BaserCore') . 'src' . DS . 'Service' . DS . 'PluginsService.php';
if(is_writable($pluginsServicePath)) {
    $isPluginsServiceWritable = true;
} else {
    $isPluginsServiceWritable = false;
}
$content = file_get_contents($pluginsServicePath);
if(!preg_match('/public function getCoreUpdate\(.+?\?bool \$force/', $content)) {
    $applied = true;
} else {
    $applied = false;
}
return [
    'title' => __d('baser_core', '最新版ダウンロード時に「Argument #3 ($force) must be of type bool, null given」エラーとなってしまう問題'),
    'detail' => '\BaserCore\Service\PluginsService の改善版を適用します。',
    'hasExecute' => true,
    'executeEnabled' => $isPluginsServiceWritable,
    'warning' => (!$isPluginsServiceWritable)? __d('baser_core', '{0} に書き込み権限を付与してください。', $pluginsServicePath) : '',
    'applied' => $applied
];
