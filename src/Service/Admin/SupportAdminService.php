<?php

namespace BcUpdateSupporter\Service\Admin;

use BcUpdateSupporter\Service\SupportService;

class SupportAdminService extends SupportService implements SupportAdminServiceInterface
{
    public function getViewVarsForIndex(string $currentVersion): array
    {
        return [
            'improvements' => $this->getImprovements($currentVersion)
        ];
    }
}
