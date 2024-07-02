<?php

namespace BcUpdateSupporter\Service;

use BaserCore\Error\BcException;
use BaserCore\Utility\BcUtil;
use Cake\Filesystem\Folder;

class SupportService implements SupportServiceInterface
{

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
            $improvementVersion = $folder;
            $improvementVerPoints[$improvementVersion] = BcUtil::verpoint($improvementVersion);
        }
        asort($improvementVerPoints);
        foreach($improvementVerPoints as $key => $improvementVerPoint) {
            if(preg_match('/^<=/', $key)) {
                if (!($currentVerPoint <= $improvementVerPoint)) continue;
            } elseif(preg_match('/^</', $key)) {
                if (!($currentVerPoint < $improvementVerPoint)) continue;
            } elseif(preg_match('/^>=/', $key)) {
                if (!($currentVerPoint >= $improvementVerPoint)) continue;
            } elseif(preg_match('/^>/', $key)) {
                if (!($currentVerPoint > $improvementVerPoint)) continue;
            } else {
                if (!($currentVerPoint === $improvementVerPoint)) continue;
            }
            $improvementPath = $path . DS . $key . DS . 'config.php';
            if (file_exists($improvementPath)) {
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

    public function execute(string $targetVersion): void
    {
        $path = BcUtil::getPluginPath('BcUpdateSupporter') . 'config' . DS . 'improvements' . DS . $targetVersion . DS . 'improvement.php';
        if(!file_exists($path)) {
            throw new BcException(__d('baser_core', '改善ファイルが見つかりませんでした。'));
        }
        include $path;
    }

}
