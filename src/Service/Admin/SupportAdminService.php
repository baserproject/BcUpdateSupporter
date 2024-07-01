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

    public function getImprovements(string $currentVersion): array
    {
        return [
            '<=5.0.19' => [
                'title' => 'v5.0.20 を指定してアップデートできない問題',
                'detail' =>
                    "v5.0.20 未満のバージョンの場合、このプラグインが有効化されていれば、v5.0.20より新しいバージョンがリリースされていたとしても強制的に v5.0.20 にアップデートします。\n" .
                    "（v5.1.0 にアップデートする場合、v5.0.20 へのアップデートが必須となるため）",
                'hasExecute' => false,
                'executeEnabled' => false,
                'message' => '',
                'applied' => false
            ],
            '5.0.19' => [
                'title' => '最新版ダウンロード時に「Argument #3 (Sforce) must be of type bool, null given」エラーとなってしまう問題',
                'detail' => '',
                'hasExecute' => true,
                'executeEnabled' => true,
                'message' => '',
                'applied' => true
            ],
        ];
    }

}
