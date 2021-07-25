<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
// user.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'user_list']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']]
]);

?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>

<div class="column-responsive column-80">
	<div class="users index content">
		<h3 class="heading"><?= __('ユーザーリスト') ?></h3>

		<h4 class='sort'>並び替え<sub>(各並び替え要素で検索可能)</sub></h4>
		<div class="sort-wrapper">
			<?= $this->Paginator->sort('username', 'アカウント名') ?>
			<?= $this->Paginator->sort('gender', '性別') ?>
			<?= $this->Paginator->sort('age', '年齢') ?>
			<?= $this->Paginator->sort('created', '登録日') ?>
			<!-- <!?= $this->Paginator->sort('編集日') ?> -->
			<?= $this->Paginator->sort('disease_categorie_id', '病名') ?>

			<div class="refined_search">
				<?= $this->Form->create(null, ['type' => 'get']) ?>
				<?= $this->Form->control('key', [
					'label' => false,
					'value' => $this->request->getQuery('key'),
					'placeholder' => '絞り込み検索'
				]) ?>
				<?= $this->Form->submit('', ["class" => 'submit_img']) ?>
				<?= $this->Form->end() ?>
			</div>
			<!-- <!?= $this->Paginator->sort('email') ?> -->
		</div>

		<div class="grid_container">
			<?php foreach ($users as $user) : ?>
				<div class="user_list">
					<?php if (empty($user->avatar)) {
						echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
					} else {
						$avatar = $user->avatar;
						echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
					} ?>
					<?= $this->Html->link(
						$user->username . "さん",
						['action' => 'view', $user->id],
						['class' => 'username']
					) ?>
					<span class="gender"><?= h($user->gender) ?>性</span>
					<?php if (empty($user->age)) : ?>
						<span class="age">非公開</span>
					<?php else : ?>
						<span class="age"><?= $this->Number->format($user->age) ?>歳</span>
					<?php endif; ?>
					<span class="label">登録日</span>
					<span class="created"><?= h($user->created->format('Y年m月d日')) ?></span>
					<span class="label">病名</span>
					<?= $user->has('disease_category') ?
						$user->disease_category->name
						: '' ?>
					<!-- <!?= h($user->email) ?> -->
				</div>
			<?php endforeach; ?>
		</div>


	</div>

	<?= $this->element('paginator') ?>

</div>