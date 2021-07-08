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

<div class="row">

	<div class="column-responsive column-80">
		<div class="users form content">
			<?= $this->Form->create($user, ['type' => 'file']) ?>
			<fieldset>
				<legend><?= __('ユーザー情報の編集') ?></legend>
				<?php
				echo $this->Form->control('アカウント名', ['name' => 'username']);
				echo $this->Form->control('image_file', ['type' => 'file']);
				echo $this->Form->control('パスワード', ['name' => 'password']);
				// echo $this->Form->control('gender', [
				// 	'options' => [
				// 		['value' => '男', 'text' => '男'],
				// 		['value' => '女', 'text' => '女']
				// 	],
				// 	'label' => ['text' => '性別']
				// ]);
				echo $this->Form->select(
					'gender',
					['', '男', '女', 'その他'],
					['empty' => ''],
					['label' => ['text' => '性別']]
				);
				echo $this->Form->control('年齢', ['name' => 'age']);
				echo $this->Form->control('disease_categorie_id', [
					'options' => $diseaseCategories,
					'label' => '病名'
				]);
				// echo $this->Form->select('disease_categorie_id', $diseaseCategories, ['default' => 3]);
				echo $this->Form->control('email', ['name' => 'email']);
				?>
			</fieldset>
			<?= $this->Form->button(__('決定')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>