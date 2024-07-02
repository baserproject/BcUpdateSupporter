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

}
