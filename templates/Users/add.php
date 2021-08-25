<?php

/**
 * @const \App\View\AppView $this
 * @const \App\Model\Entity\User $user
 */
// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => '新規アカウント作成']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);
?>

<div class="column-responsive column-80">
	<h1><?= __('新規アカウント作成') ?></h1>
	<div class="form content">
		<?= $this->Form->create($user, ['type' => 'file']) ?>
		<fieldset class="grid">
			<div class="avatar_wrapper">
				<?php if (empty($user->avatar)) {
					echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar', 'name' => 'avatar']);
				} else {
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar', 'name' => 'avatar']);
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
			<?= $this->Form->control('username', ['class' => 'username', 'label' => false]) ?>
			<div class="flex_wrapper passBox">
				<?= $this->Form->label('パスワード') ?>
				<span class="form_label">必須</span>
			</div>
			<?= $this->Form->control('password', ['type' => 'password', 'class' => 'password', 'label' => false]) ?>
			<span id="password_buttonEye" class="fa fa-eye" onclick="password_pushHideButton()"></span>
			<?= $this->Form->control(
				'password_confirm',
				['type' => 'password', 'label' => '確認用パスワード']
			) ?>
			<span id="password-confirm_buttonEye" class="fa fa-eye" onclick="password_confirm_pushHideButton()"></span>

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
			<?= $this->Form->control('email', ['class' => 'email', 'label' => false]) ?>

			<?= $this->Form->button(__('送信')) ?>

		</fieldset>
		<?= $this->Form->end() ?>
	</div>

	<?php
	$this->start("script");
	echo $this->Html->script('imgPreView');
	echo $this->Html->script('password_pushHideButton');
	$this->end();
	?>
