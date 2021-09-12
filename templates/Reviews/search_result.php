<?php

/**
 */
// clinic_list.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'clinic_list', 'user_list']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => '検索結果', 'url' => null]
]);

?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>
<?php if (isset($clinic)) : ?>
	<h2>検索結果は<?= count($clinic) ?>件です。</h2>
	<div class="flex_container">
		<?php foreach ($clinic as $clinic) : ?>
			<div class="clinic_list">
				<!-- <!?= $this->Number->format($clinic->id) ?> -->
				<h4 class="clinic_name">
					<?= $this->Html->link(
						$clinic->name,
						['controller' => 'Clinics', 'action' => 'view', $clinic->id]
					) ?>
				</h4>
				<?php if (empty($clinic->image)) {
					echo $this->Html->image("upload/no-image.jpg", ['alt' => 'clinic image', 'class' => 'thumbnail']);
				} else {
					$image = $clinic->image;
					echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'thumbnail']);
				} ?>
				<!-- <!?= h($clinic->created) ?> -->
				<!-- <!?= h($clinic->modified) ?> -->
				<span class="address"><?= h($clinic->address) ?></span>
				<span class="station">最寄り駅　<?= h($clinic->station) ?></span>
				<!-- <!?= h($clinic->time) ?> -->
				<span class="phone_number">TEL-<?= h($clinic->phone_number) ?></span>
			</div>

		<?php endforeach; ?>
	</div>

<?php elseif (isset($user)) : ?>
	<h2>検索結果は<?= count($user) ?>件です。</h2>
	<div class="grid_container">
		<?php foreach ($user as $user) : ?>
			<div class="user_list">
				<?php if (empty($user->avatar)) {
					echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
				} else {
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
				} ?>
				<?= $this->Html->link(
					$user->username . "さん",
					['controller' => 'Users', 'action' => 'view', $user->id],
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
				<?= $user->has('disease_category') ? $this->Html->link(
					$user->disease_category->name,
					['controller' => 'DiseaseCategories', 'action' => 'view', $user->disease_category->id],
					['class' => 'disease']
				) : '' ?>
				<!-- <!?= h($user->email) ?> -->
			</div>
		<?php endforeach; ?>
	</div>

<?php else: ?>
	<h2>検索結果はありませんでした。</h2>
<?php endif ?>