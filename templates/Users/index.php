<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
// user.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'user_list']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => null]
]);

?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>

<div class="column-responsive column-80">
	<div class="users index content">
		<h3 class="heading"><?= __('ユーザーリスト') ?></h3>

		<h4 class='sort'>並び替え</h4>
		<div class="sort-wrapper">
			<?= $this->Paginator->sort('username', 'アカウント名') ?>
			<?= $this->Paginator->sort('gender', '性別') ?>
			<?= $this->Paginator->sort('age', '年齢') ?>
			<?= $this->Paginator->sort('created', '登録日') ?>
			<!-- <!?= $this->Paginator->sort('編集日') ?> -->
			<?= $this->Paginator->sort('disease_categorie_id', '病名') ?>
			<!-- <!?= $this->Paginator->sort('email') ?> -->
		</div>

		<div class="grid_container">
			<?php foreach ($users as $user) : ?>
				<div class="user_list">
					<?php
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
					?>
					<?= $this->Html->link(
						$user->username . "さん",
						['action' => 'view', $user->id],
						['class' => 'username']
					) ?>
					<span class="gender"><?= h($user->gender) ?>性</span>
					<span class="age"><?= $this->Number->format($user->age) ?>歳</span>
					<span class="label">登録日</span>
					<span class="created"><?= h($user->created->format('Y年m月d日')) ?></span>
					<span class="label">病名</span>
					<?= $user->has('disease_category') ? $this->Html->link(
						$user->disease_category->name,
						['controller' => 'DiseaseCategories', 'action' => 'view', $user->disease_category->id],
						['class' => 'disease']
					) : '' ?>
					<!-- <!?= h($user->email) ?> -->
				</div>
			<?php endforeach; ?>
		</div>


	</div>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->first('<< ') ?>
			<?= $this->Paginator->prev(__('前へ')) ?>
			<?= $this->Paginator->numbers(['modulus' => 4, 'after' => '…']) ?>
			<?= $this->Paginator->next(__('次へ')) ?>
			<?= $this->Paginator->last(' >>') ?>
			<li class="page_count"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}')) ?></li>
		</ul>
		<!--<p><!?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>-->
	</div>
</div>