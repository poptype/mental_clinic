<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(__('アカウントを削除する'), ['action' => 'delete', $session_id], ['confirm' => __('本当に 『'. "$session_name". '』さんのアカウントを削除しますか？', $session_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('ユーザーリスト'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('ユーザー情報の編集') ?></legend>
                <?php
                    echo $this->Form->control('アカウント名', ['name' => 'username']);
                    echo $this->Form->control('パスワード', ['name' => 'password']);
                    echo $this->Form->control('gender', [
                      'options' => ['男', '女'],
                      'label' => [
                        'text' => '性別']
                    ]);
                    echo $this->Form->control('年齢', ['name' => 'age']);
                    echo $this->Form->control(
                        '病名',
                        [
                        'options' => $diseaseCategories,
                        'name' => 'disease_category_id'
                        ]
                    );
                    echo $this->Form->control('email', ['name' => 'email']);
                    ?>
            </fieldset>
            <?= $this->Form->button(__('決定')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
