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

use BcUpdateSupporter\Service\SupportService;

/**
 * Class SupportAdminService
 */
class SupportAdminService extends SupportService implements SupportAdminServiceInterface
{

    /**
     * ビュー変数を取得する
     * @param string $currentVersion
     * @return array
     */
    public function getViewVarsForIndex(string $currentVersion): array
    {
        return [
            'improvements' => $this->getImprovements($currentVersion)
        ];
    }

}
