<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */
namespace BcUpdateSupporter\Service;

/**
 * Interface SupportServiceInterface
 */
interface SupportServiceInterface
{

    /**
     * バージョンに応じた改善事項を取得する
     * @param string $currentVersion
     * @return array
     */
    public function getImprovements(string $currentVersion): array;

    /**
     * 改善事項を実行する
     * @param string $targetVersion
     * @return void
     */
    public function execute(string $targetVersion): void;

}
