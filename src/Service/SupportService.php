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
use BaserCore\Service\PluginsServiceInterface;
use BaserCore\Utility\BcContainerTrait;
use BaserCore\Utility\BcFolder;
use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;
use Cake\Core\Plugin as CakePlugin;
use Cake\ORM\TableRegistry;
use Migrations\Migrations;

/**
 * Class SupportService
 */
class SupportService implements SupportServiceInterface
{

    /**
     * Trait
     */
    use BcContainerTrait;

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

        if (BcUtil::is51()) {
            $folder = new BcFolder($path);
        } else {
            $folder = new \Cake\Filesystem\Folder($path);
        }

        $files = $folder->read(true, true);
        $improvements = [];
        $improvementVerPoints = [];
        if (empty($files[0])) return [];
        foreach($files[0] as $folder) {
            $improvementVerPoints[$folder] = BcUtil::verpoint($folder);
        }
        asort($improvementVerPoints);
        foreach($improvementVerPoints as $key => $improvementVerPoint) {
            if (preg_match('/^smaller-/', $key)) {
                if (!($currentVerPoint < $improvementVerPoint)) continue;
            } elseif (preg_match('/^bigger-/', $key)) {
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
        if (!file_exists($path)) {
            throw new BcException(__d('baser_core', '改善ファイルが見つかりませんでした。'));
        }
        include $path;
    }

    /**
     * スクリプトを実行する
     * @param string $version
     * @return void
     */
    public function script(string $version)
    {
        $corePlugins = array_merge(['BaserCore'], Configure::read('BcApp.corePlugins'));
        foreach($corePlugins as $corePlugin) {
            $plugin = CakePlugin::getCollection()->create($corePlugin);
            $plugin->execScript($version);
        }
    }

    /**
     * DBのバージョン番号を更新する
     * @param string $version
     * @return void
     */
    public function updateDbVersion(string $version)
    {
        $corePlugins = array_merge(['BaserCore'], Configure::read('BcApp.corePlugins'));
        $pluginsTable = TableRegistry::getTableLocator()->get('BaserCore.Plugins');
        foreach($corePlugins as $corePlugin) {
            $pluginsTable->update($corePlugin, $version);
        }
    }

    /**
     * マイグレーションを実行する
     * 一度インストールされたプラグインが対象
     * @return void
     */
    public function migration()
    {
        $pluginsTable = TableRegistry::getTableLocator()->get('BaserCore.Plugins');
        $pluginsTable->setDisplayField('name');
        $corePlugins = array_merge(['BaserCore'], $pluginsTable->find('list')
            ->all()
            ->toArray()
        );
        $pluginCollection = CakePlugin::getCollection();
        foreach($corePlugins as $corePlugin) {
            $plugin = $pluginCollection->create($corePlugin);
            $plugin->migrate();
        }
    }

    /**
     * マイグレーション済みとしてマーキングする
     * 一度インストールされたプラグインが対象
     * @return void
     */
    public function markMigrated()
    {
        $pluginsTable = TableRegistry::getTableLocator()->get('BaserCore.Plugins');
        $pluginsTable->setDisplayField('name');
        $corePlugins = array_merge(['BaserCore'], $pluginsTable->find('list')
            ->all()
            ->toArray()
        );
        $migrations = new Migrations();

        foreach($corePlugins as $corePlugin) {
            // status を実行しないと、markMigrated が正常に動作しない
            $migrations->status(['plugin' => $corePlugin]);
            $migrations->markMigrated(null, ['plugin' => $corePlugin]);
        }
    }

}
