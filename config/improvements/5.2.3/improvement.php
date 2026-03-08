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
 * 5.1.0 improvement
 */
$targetPath1 = ROOT . DS . 'composer.json';
$srcPath1 = __DIR__ . DS . 'composer.json';
$targetPath2 = ROOT . DS . 'composer.lock';
$srcPath2 = __DIR__ . DS . 'composer.lock';
if(!copy($srcPath1, $targetPath1) || !copy($srcPath2, $targetPath2)) {
    throw new \BaserCore\Error\BcException(__d(
    	'baser_core',
    	"ファイルのコピーに失敗しました。手動で適用してください。\n{0} => {1}\n{2} => {3}",
    	$srcPath1,
    	$targetPath1
	));
}
