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
 * @var array $scriptVersions
 */
$this->BcAdmin->setTitle(__d('baser_core', 'スクリプト実行'));
?>


<div class="bca-main__section">
  <h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'スクリプト実行') ?></h2>
  <p class="bca-main__text">
    <?php echo __d('baser_core', 'アップデート時に何らかの問題でスクリプトが実行されなかった場合に、バージョンを指定して個別にスクリプトを実行します。') ?>
  </p>
  <?php echo $this->BcAdminForm->create(null, ['url' => ['action' => 'script'], 'id' => 'AdminScriptForm']) ?>
  <?php echo $this->BcAdminForm->control('target_version', [
    'type' => 'select',
    'options' => $scriptVersions,
    'empty' => __d('baser_core', 'バージョンを選択してください')
  ]) ?>
  <?php echo $this->BcAdminForm->control('mode', ['type' => 'hidden', 'value' => 'script']) ?>
  <?php echo $this->BcAdminForm->submit(__d('baser_core', 'スクリプト実行'), [
    'class' => 'bca-btn',
  ]) ?>
  <?php echo $this->BcAdminForm->end() ?>
</div>

<?= $this->Html->scriptBlock("
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('AdminScriptForm');
        form.addEventListener('submit', function(event) {
            if (!confirm('本当に実行してもいいですか？')) {
                event.preventDefault();
            }
            $.bcUtil.showLoader();
        });
    });
") ?>

<div class="bca-main__section">
  <h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'DBのバージョン番号更新') ?></h2>
  <p class="bca-main__text">
    <?php echo __d('baser_core', 'アップデート時に何らかの問題でDBのバージョン番号が更新されなかった場合に、バージョンを指定して更新します。') ?>
  </p>
  <?php echo $this->BcAdminForm->create(null, ['url' => ['action' => 'script'], 'id' => 'AdminUpdateDbVersionForm']) ?>
  <?php echo $this->BcAdminForm->control('target_version', [
    'type' => 'text',
    'size' => '40',
    'placeholder' => __d('baser_core', 'バージョン番号を指定してください')
  ]) ?>
  <?php echo $this->BcAdminForm->control('mode', ['type' => 'hidden', 'value' => 'update_db_version']) ?>
  <?php echo $this->BcAdminForm->submit(__d('baser_core', 'DBのバージョンを更新'), [
    'class' => 'bca-btn',
  ]) ?>
  <?php echo $this->BcAdminForm->end() ?>
</div>

<?= $this->Html->scriptBlock("
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('AdminUpdateDbVersionForm');
        form.addEventListener('submit', function(event) {
            if (!confirm('本当に実行してもいいですか？')) {
                event.preventDefault();
            }
            $.bcUtil.showLoader();
        });
    });
") ?>
