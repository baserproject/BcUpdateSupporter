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

namespace BcUpdateSupporter;

use BaserCore\BcPlugin;
use BcUpdateSupporter\ServiceProvider\BcUpdateSupporterServiceProvider;
use Cake\Core\ContainerInterface;
use Cake\Routing\RouteBuilder;

/**
 * Plugin for BcUpdateSupporter
 */
class BcUpdateSupporterPlugin extends BcPlugin
{

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
        // Register your services here

        $container->addServiceProvider(new BcUpdateSupporterServiceProvider());
    }

}
