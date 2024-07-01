<?php
declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcUpdateSupporter\Event;

use BaserCore\Event\BcControllerEventListener;
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
        'Plugins.startup',
    ];

    /**
     * Services
     * @param Event $event
     */
    public function pluginsStartup(Event $event): void
    {

    }

}
