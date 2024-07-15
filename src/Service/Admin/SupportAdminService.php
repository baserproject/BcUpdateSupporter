<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcUpdateSupporter\Service\Admin;

use BaserCore\Utility\BcUtil;
use BcUpdateSupporter\Service\SupportService;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;

/**
 * Class SupportAdminService
 */
class SupportAdminService extends SupportService implements SupportAdminServiceInterface
{

    /**
     * アップデート時の問題画面用のビュー変数を取得する
     * @param string $currentVersion
     * @return array
     */
    public function getViewVarsForIndex(string $currentVersion): array
    {
        return [
            'improvements' => $this->getImprovements($currentVersion)
        ];
    }

    /**
     * スクリプト実行画面用のビュー変数を取得する
     * @return array
     */
    public function getViewVarsForScript(): array
    {
        return [
            'scriptVersions' => $this->scriptVersions()
        ];
    }

    /**
     * スクリプトのバージョンを取得する
     * @return string[]
     */
    public function scriptVersions()
    {
        $corePlugins = Configure::read('BcApp.corePlugins');
        $scriptsTmp = ['BaserCore' => $this->getPluginScriptVersions('BaserCore')];
        foreach($corePlugins as $corePlugin) {
            $scriptsTmp[$corePlugin] = $this->getPluginScriptVersions($corePlugin);
        }
        $scripts = [];
        foreach($scriptsTmp as $versions) {
            foreach($versions as $version) {
                if(in_array($version, $scripts)) continue;
                $scripts[$version] = BcUtil::verpoint($version);
            }
        }
        asort($scripts);
        $keys = array_keys($scripts);
        $scripts = array_combine($keys, $keys);
        return $scripts;
    }

    /**
     * プラグインごとのスクリプトのバージョンを取得する
     * @param string $name
     * @return array
     */
    public function getPluginScriptVersions(string $name)
    {
        // 有効化されていない可能性があるため CakePlugin::path() は利用しない
        $path = BcUtil::getPluginPath($name) . 'config' . DS . 'update';
        if(BcUtil::is51()) {
            $folder = new \BaserCore\Utility\BcFolder($path);
        } else {
            $folder = new Folder($path);
        }
        $files = $folder->read(true, true);
        $updaters = [];
        if (empty($files[0])) return[];
        foreach($files[0] as $folder) {
            if(preg_match('/^(\d+\.\d+\.\d+)$/', $folder)) {
                $updaters[] = $folder;
            }
        }
        return $updaters;
    }

}
