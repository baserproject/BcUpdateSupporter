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
    public function index(SupportAdminServiceInterface $service)
    {
        if($this->getRequest()->is('post')) {
            $service->execute($this->getRequest()->getParam('pass.0'));
            $this->Flash->success(__d('baser_core', '改善完了！' . $this->getRequest()->getParam('pass.0')));
            $this->redirect(['action' => 'index']);
        }
        $this->set($service->getViewVarsForIndex(BcUtil::getVersion()));
    }
}
