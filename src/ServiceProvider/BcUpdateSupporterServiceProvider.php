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

namespace BcUpdateSupporter\ServiceProvider;

use BcUpdateSupporter\Service\Admin\SupportAdminService;
use BcUpdateSupporter\Service\Admin\SupportAdminServiceInterface;
use BcUpdateSupporter\Service\SupportService;
use BcUpdateSupporter\Service\SupportServiceInterface;
use Cake\Core\ServiceProvider;

/**
 * BcUpdateSupporter Service Provider
 */
class BcUpdateSupporterServiceProvider extends ServiceProvider
{

    public function __construct()
    {
        $this->provides = [
            SupportServiceInterface::class,
            SupportAdminServiceInterface::class,
        ];
    }

    /**
     * Services
     * @param \Cake\Core\ContainerInterface $container
     */
    public function services($container): void
    {
        $container->defaultToShared(true);
        $container->add(SupportServiceInterface::class, SupportService::class);
        $container->add(SupportAdminServiceInterface::class, SupportAdminService::class);
    }

}
