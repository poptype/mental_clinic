<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');

$query = $diseaseCategories->find('list')->toArray();

// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => '確認画面']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>

<div class="column-responsive column-80">
	<div class=" users form content">
		<?= $this->Form->create($user, ['type' => 'post', ['controller' => 'Users', 'action' => 'complete']]) ?>
		<fieldset class="grid">
			<legend><?= __('入力情報の確認') ?></legend>
			<div class="avatar_wrapper">
				<?php if (empty($user->avatar)) {
					echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
				} else {
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
				} ?>
			</div>
			<!-- <!?= $this->Form->control('username', ['label' => 'アカウント名', 'div' => false]) ?> -->
			<?= $this->Form->label('アカウント名') ?>
			<?= $user->username ?>
			<?= $this->Form->label('パスワード') ?>
			<?= h($user->password) ?>


			<!-- echo $this->Form->control('gender', [
'options' => [
['value' => '男', 'text' => '男'],
['value' => '女', 'text' => '女']
],
'label' => ['text' => '性別']
]); -->

			<?= $this->Form->label('性別'); ?>
			<?= $user->gender ?>
			<?= $this->Form->label('年齢') ?>
			<?= $user->age ?>
			<?= $this->Form->label('病名') ?>
			<?= $query[$user->disease_categorie_id] ?>
			<?= $this->Form->label('Email') ?>
			<?= $user->email ?>
			<?= $this->Form->button(__('登録完了'), ['type' => 'submit']) ?>

		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div>