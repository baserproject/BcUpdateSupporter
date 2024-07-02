<?php
declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcUpdateSupporter\Event;

use BaserCore\Event\BcControllerEventListener;
use BaserCore\Utility\BcUtil;
use Cake\Cache\Cache;
use Cake\Event\Event;

/**
 * BcUpdateSupporter Controller Event Listener
 */
class BcUpdateSupporterControllerEventListener extends BcControllerEventListener
{

    /**
     * events
     * @var string[]
     */
    public $events = [
        'BaserCore.Plugins.startup',
    ];

    /**
     * BaserCore Plugins startup
     * @param Event $event
     */
    public function baserCorePluginsStartup(Event $event): void
    {
        if(BcUtil::verpoint(BcUtil::getVersion()) < BcUtil::verpoint('5.0.20')) {
            $this->forBefore_5_0_20($event);
        }
    }

    /**
     * 5.0.20 以前のバージョンのための処理
     *
     * 5.1.0 へのバージョンアップは、5.0.20 へのアップデートが必須のため
     * 強制的に 5.0.20 へアップデートを行う処理とする。
     *
     * @param Event $event
     * @return void
     */
    public function forBefore_5_0_20(Event $event)
    {
        $controller = $event->getSubject();
        $request = $controller->getRequest();
        if(BcUtil::verpoint(BcUtil::getVersion()) === BcUtil::verpoint('5.0.19')) {
            // 5.0.19 の場合
            if($this->isAction('Plugins.Update')) {
                if(!Cache::read('coreDownloaded', '_bc_update_')) {
                    $controller->BcMessage->setInfo(__d('baser_core', 'アップデートサポータープラグインにより、強制的に v5.0.20 をダウンロードします。'));
                }
            } elseif($this->isAction('Plugins.GetCoreUpdate')) {
                if($request->is('post')) {
                    $controller->setRequest($request->withData('targetVersion', '5.0.20'));
                }
            }
        } else {
            // 5.0.18 以下の場合
            if($this->isAction('Plugins.Update')) {
                if(!$request->is('post')) {
                    $controller->BcMessage->setInfo(__d('baser_core', 'アップデートサポータープラグインにより、強制的に v5.0.20 にアップデートします。'));
                }
            }
        }
    }

}
