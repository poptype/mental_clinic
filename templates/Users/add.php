<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => 'ユーザー情報の入力']
	]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);
?>
<div class="row">
	<aside class="column">
		<div class="side-nav">
			<h4 class="heading"><?= __('Actions') ?></h4>
			<?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
		</div>
	</aside>
	<div class="column-responsive column-80">
		<div class="users form content">
			<?= $this->Form->create($user, ['type'=>'file']) ?>
			<fieldset>
				<legend><?= __('新規アカウント作成') ?></legend>
				<?php
				echo $this->Form->control('username', ['label' => 'アカウント名']);
				echo $this->Form->control('image_file', ['type' => 'file']);
				echo $this->Form->control('password', ['label' => 'パスワード']);
				echo $this->Form->control('age', ['label' => '年齢']);
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
				);
				// echo $this->Form->control('disease_categorie_id', [
				// 	'options' => $diseaseCategories,
				// 	'label' => '病名'
				// ]);
				echo var_dump($diseaseCategories);
				echo $this->Form->select('disease_categorie_id', $diseaseCategories, ['default' => 3 ]);
				echo $this->Form->control('email');
				?>
			</fieldset>
			<?= $this->Form->button(__('送信')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>