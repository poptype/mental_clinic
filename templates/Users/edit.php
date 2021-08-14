<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');

// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => 'ユーザー情報の編集']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>

<div class="column-responsive column-80">
	<div class=" users form content">
		<?= $this->Form->create($user, ['type' => 'file']) ?>
		<fieldset class="grid">
			<legend class="heading_line"><?= __('ユーザー情報の編集') ?></legend>
			<div class="avatar_wrapper">
				<?php if (empty($user->avatar)) {
					echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
				} else {
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
				} ?>

				<?= $this->Form->control('image_file', [
					'type' => 'file',
					'onChange' => 'imgPreView(event)',
					'label' => '変更'
				]); ?>
			</div>
			<!-- <!?= $this->Form->control('username', ['label' => 'アカウント名', 'div' => false]) ?> -->
			<div class="flex_wrapper"><?= $this->Form->label('アカウント名') ?>
				<span class="form_label">必須</span>
			</div>
			<?= $this->Form->text('username', ['class' => 'username']) ?>
			<div class="flex_wrapper passBox">
				<?= $this->Form->label('パスワード') ?>
				<span class="form_label">必須</span>
			</div>
			<?= $this->Form->text('password', ['type' => 'password', 'class' => 'password']) ?>
			<?= $this->Form->control(
				'password_confirm',
				['type' => 'password', 'label' => '確認用パスワード', 'value' => $user->password]
			) ?>


			<?= $this->Form->control('gender', [
				'options' => [
					['value' => '男', 'text' => '男'],
					['value' => '女', 'text' => '女'],
					['value' => 'その他', 'text' => 'その他']
				],
				'label' => ['text' => '性別'],
			]); ?>

			<?= $this->Form->control('age', ['label' => '年齢']) ?>
			<?php echo $this->Form->control('disease_categorie_id', [
				'options' => $diseaseCategories,
				'label' => '病名',
			]); ?>
			<div class="flex_wrapper emailBox">
				<?= $this->Form->label('Email') ?>
				<span class="form_label">必須</span>
			</div>
			<?= $this->Form->text('email', ['class' => 'email']) ?>

			<?= $this->Form->button(__('決定')) ?>

		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div>

<?php
$this->start("script");
echo $this->Html->script('imgPreView');;
$this->end();
?>