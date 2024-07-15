<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcUpdateSupporter\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use BaserCore\Utility\BcUtil;
use BcUpdateSupporter\Service\Admin\SupportAdminService;
use BcUpdateSupporter\Service\Admin\SupportAdminServiceInterface;

/**
 * Class SupportController
 */
class SupportController extends BcAdminAppController
{

    /**
     * アップデートサポーター
     *
     * @param SupportAdminServiceInterface|SupportAdminService $service
     * @return void
     */
    public function index(SupportAdminServiceInterface $service, $targetVersion = null)
    {
        if($this->getRequest()->is('post')) {
            try {
                $service->execute($targetVersion);
                $this->BcMessage->setSuccess(__d('baser_core', '{0} の改善が完了しました。', $targetVersion));
            } catch (\Exception $e) {
                $this->BcMessage->setError($e->getMessage());
            }
            $this->redirect(['action' => 'index']);
        }
        $this->set($service->getViewVarsForIndex(BcUtil::getVersion()));
    }

    /**
     * マイグレーション実行
     *
     * @param SupportAdminServiceInterface|SupportAdminService $service
     * @return void
     */
    public function migration(SupportAdminServiceInterface $service)
    {
        if($this->getRequest()->is('post')) {
            try {
                if($this->getRequest()->getData('mode') === 'apply') {
                    $service->migration();
                    $this->BcMessage->setSuccess(__d('baser_core', 'マイグレーションの適用が完了しました。'));
                } elseif($this->getRequest()->getData('mode') === 'mark') {
                    $service->markMigrated();
                    $this->BcMessage->setSuccess(__d('baser_core', 'マイグレーション済みとしてマーキングしました。'));
                } else {
                    $this->BcMessage->setError(__d('baser_core', '不正なアクセスです。'));
                }
            } catch (\Exception $e) {
                $this->BcMessage->setError($e->getMessage());
            }
            $this->redirect(['action' => 'migration']);
        }
    }

    /**
     * スクリプト実行
     *
     * @param SupportAdminServiceInterface|SupportAdminService $service
     * @return void
     */
    public function script(SupportAdminServiceInterface $service)
    {
        if($this->getRequest()->is('post')) {
            try {
                if($this->getRequest()->getData('mode') === 'script') {
                    $service->script($this->getRequest()->getData('target_version'));
                    $this->BcMessage->setSuccess(__d('baser_core', 'スクリプトの実行が完了しました。'));
                } elseif($this->getRequest()->getData('mode') === 'update_db_version') {
                    $service->updateDbVersion($this->getRequest()->getData('target_version'));
                    $this->BcMessage->setSuccess(__d('baser_core', 'DBのバージョン更新が完了しました。'));
                } else {
                    $this->BcMessage->setError(__d('baser_core', '不正なアクセスです。'));
                }
            } catch (\Exception $e) {
                $this->BcMessage->setError($e->getMessage());
            }
            $this->redirect(['action' => 'script']);
        }
        $this->set($service->getViewVarsForScript());
    }

}
