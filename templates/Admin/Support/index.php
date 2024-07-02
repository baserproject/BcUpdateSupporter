<?php
/**
 * @var \BaserCore\View\BcAdminAppView $this
 * @var array $improvements
 */
$this->BcAdmin->setTitle('アップデートサポーター');
?>


<p><?php echo __d('baser_core', 'アップデートサポータープラグインは、baserCMSのアップデート時の問題をサポートします。') ?></p>

<p style="margin-bottom:40px;">現在のバージョン：<?php echo \BaserCore\Utility\BcUtil::getVersion() ?></p>

<h2 class="bca-main__heading" data-bca-heading-size="lg">アップデート時の問題一覧</h2>

<?php if ($improvements): ?>
  <table class="bca-table-listup">
    <?php foreach($improvements as $key => $improvement): ?>
      <tr>
        <td class="bca-table-listup__tbody-td"><?php echo h($key) ?></td>
        <td class="bca-table-listup__tbody-td"><?php echo h($improvement['title']) ?></td>
        <td class="bca-table-listup__tbody-td">
          <p><?php echo nl2br(h($improvement['detail'])) ?></p>
          <?php if ($improvement['applied']): ?>
            <p><?php echo __d('baser_core', '改善適用済み') ?></p>
          <?php else: ?>
            <?php if ($improvement['hasExecute'] && !$improvement['applied']): ?>
              <?php if ($improvement['warning']): ?>
                <p class="error-message" style="white-space: break-spaces"><?php echo h($improvement['warning']) ?></p>
              <?php endif ?>
              <?php if ($improvement['executeEnabled']): ?>
                <p><?php echo $this->BcAdminForm->postLink(
                    __d('baser_core', '改善実行'),
                    [$key],
                    ['class' => 'bca-btn', 'disabled' => !$improvement['executeEnabled']]
                  ) ?></p>
              <?php else: ?>
                <p><?php echo $this->BcAdminForm->button(
                    __d('baser_core', '改善実行'),
                    ['class' => 'bca-btn', 'disabled' => 'disabled']
                  ) ?></p>
              <?php endif ?>
            <?php endif ?>
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
<?php else: ?>
  <p><?php echo __d('baser_core', '問題はありません。') ?></p>
<?php endif ?>
