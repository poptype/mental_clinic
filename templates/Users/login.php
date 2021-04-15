<!-- in /templates/Users/login.php -->
<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>アカウントログイン</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ユーザー名とパスワードを入力してください') ?></legend>
        <?= $this->Form->control('username', [
          'required' => true,
          'label' => 'ユーザーネーム'
        ]) ?>
        <?= $this->Form->control('password', [
          'required' => true,
          'label' => 'パスワード'
        ]) ?>
    </fieldset>
    <?= $this->Form->submit(__('送信')); ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link("新規ユーザー登録", ['action' => 'add']) ?>
</div
