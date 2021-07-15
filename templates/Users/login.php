<!-- in /templates/Users/login.php -->
<?php
// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'login']));

$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ログインフォーム']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);
?>

<h2>アカウントログイン</h2>
<div class="column-responsive column-80">
	<div class="grid users form content">
		<!-- <!?= $this->Flash->render() ?> -->

		<?= $this->Form->create() ?>
		<fieldset>
			<legend><?= __('ユーザー名とパスワードを入力してください') ?></legend>
			<?= $this->Form->control('username', [
				'required' => true,
				'label' => 'ユーザーネーム',
				'placeholder' => 'ユーザーネームを入力して下さい。'
			]) ?>
			<?= $this->Form->control('password', [
				'required' => true,
				'label' => 'パスワード',
				'placeholder' => 'パスワードを入力して下さい。'
			]) ?>
		</fieldset>
		<?= $this->Form->submit(__('ログイン')); ?>
		<?= $this->Form->end() ?>
		<?= $this->Html->link("新規ユーザー登録", ['action' => 'add'], ['class' => 'label']) ?>
	</div>
</div>