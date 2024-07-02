<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */
namespace BcUpdateSupporter\Service;

use BaserCore\Error\BcException;
use BaserCore\Utility\BcUtil;
use Cake\Filesystem\Folder;

/**
 * Class SupportService
 */
class SupportService implements SupportServiceInterface
{

    /**
     * 改善情報を取得する
     * @param string $currentVersion
     * @return array
     */
    public function getImprovements(string $currentVersion): array
    {
        $currentVerPoint = BcUtil::verpoint($currentVersion);
        if ($currentVerPoint === false) return [];

        // 有効化されていない可能性があるため CakePlugin::path() は利用しない
        $path = BcUtil::getPluginPath('BcUpdateSupporter') . 'config' . DS . 'improvements';
        $folder = new Folder($path);
        $files = $folder->read(true, true);
        $improvements = [];
        $improvementVerPoints = [];
        if (empty($files[0])) return [];
        foreach($files[0] as $folder) {
            $improvementVerPoints[$folder] = BcUtil::verpoint($folder);
        }
        asort($improvementVerPoints);
        foreach($improvementVerPoints as $key => $improvementVerPoint) {
            if(preg_match('/^smaller-/', $key)) {
                if (!($currentVerPoint < $improvementVerPoint)) continue;
            } elseif(preg_match('/^bigger-/', $key)) {
                if (!($currentVerPoint > $improvementVerPoint)) continue;
            } else {
                if (!($currentVerPoint === $improvementVerPoint)) continue;
            }
            $improvementPath = $path . DS . $key . DS . 'config.php';
            if (file_exists($improvementPath)) {
                $key = preg_replace('/^smaller-/', '<', $key);
                $key = preg_replace('/^bigger-/', '>', $key);
                $improvements[$key] = array_merge([
                    'title' => '',
                    'detail' => '',
                    'hasExecute' => false,
                    'executeEnabled' => false,
                    'warning' => '',
                    'applied' => false
                ], include $improvementPath);
            }
        }
        return $improvements;
    }

    /**
     * 改善を実行する
     * @param string $targetVersion
     * @return void
     */
    public function execute(string $targetVersion): void
    {
        $path = BcUtil::getPluginPath('BcUpdateSupporter') . 'config' . DS . 'improvements' . DS . $targetVersion . DS . 'improvement.php';
        if(!file_exists($path)) {
            throw new BcException(__d('baser_core', '改善ファイルが見つかりませんでした。'));
        }
        include $path;
    }

}
