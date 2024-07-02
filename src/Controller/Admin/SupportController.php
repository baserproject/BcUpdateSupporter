<?php
namespace BcUpdateSupporter\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use BaserCore\Utility\BcUtil;
use BcUpdateSupporter\Service\Admin\SupportAdminService;
use BcUpdateSupporter\Service\Admin\SupportAdminServiceInterface;

class SupportController extends BcAdminAppController
{

    /**
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
