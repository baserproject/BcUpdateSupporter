<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @license       https://basercms.net/license/index.html MIT License
 */

/**
 * @var \BaserCore\View\BcAdminAppView $this
 */
$this->BcAdmin->setTitle(__d('baser_core', 'マイグレーション実行'));
?>


<div class="bca-main__section">
  <h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'マイグレーションを適用する') ?></h2>
  <p class="bca-main__text">
    <?php echo __d('baser_core', 'アップデート時に何らかの問題でマイグレーションが適用されなかった場合に、マイグレーションを全て適用します。') ?>
  </p>
  <?php echo $this->BcAdminForm->create(null, ['url' => ['action' => 'migration'], 'id' => 'AdminMigrationForm']) ?>
  <?php echo $this->BcAdminForm->control('mode', ['type' => 'hidden', 'value' => 'apply']) ?>
  <?php echo $this->BcAdminForm->submit(__d('baser_core', 'マイグレーション適用'), [
    'class' => 'bca-btn',
  ]) ?>
  <?php echo $this->BcAdminForm->end() ?>
</div>

<?= $this->Html->scriptBlock("
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('AdminMigrationForm');
        form.addEventListener('submit', function(event) {
            if (!confirm('本当に実行してもいいですか？')) {
                event.preventDefault();
            }
            $.bcUtil.showLoader();
        });
    });
") ?>

<div class="bca-main__section">
  <h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'マイグレーション済みとしてマーキングする') ?></h2>
  <p class="bca-main__text">
    <?php echo __d('baser_core', 'アップデート時に何らかの問題で、マイグレーションが適用されているにもかかわらず、' .
    'マイグレーションが適応されていない状態としてシステムが認識した場合に、' .
    'マイグレーション済みとしてマーキングします。') ?>
  </p>
  <?php echo $this->BcAdminForm->create(null, ['url' => ['action' => 'migration'], 'id' => 'AdminMarkMigratedForm']) ?>
  <?php echo $this->BcAdminForm->control('mode', ['type' => 'hidden', 'value' => 'mark']) ?>
  <?php echo $this->BcAdminForm->submit(__d('baser_core', 'マイグレーション済みとしてマーキング'), [
    'class' => 'bca-btn',
  ]) ?>
  <?php echo $this->BcAdminForm->end() ?>
</div>

<?= $this->Html->scriptBlock("
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('AdminMarkMigratedForm');
        form.addEventListener('submit', function(event) {
            if (!confirm('本当に実行してもいいですか？')) {
                event.preventDefault();
            }
            $.bcUtil.showLoader();
        });
    });
") ?>


