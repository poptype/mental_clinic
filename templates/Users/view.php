<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
// user.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'user']));
// --clinicsテーブルから配列でエンティティを取得　＊スコープの関係上 $clinicsはここでqueryオブジェクトに変換-- /
$query = $clinics->find('list')->toArray();
// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => $user->username . "さんのプロフィール", 'url' => null]
]);
?>
<!-- <aside class="column">
		<div class="side-nav">
			<h4 class="heading"><!?= __('Actions') ?></h4>
			<!?= $this->Html->link(__('プロフィール編集'), ['action' => 'edit', $session_id], ['class' => 'side-nav-item']) ?>
			<!?= $this->Form->postLink(__('アカウントを削除する'), ['action' => 'delete', $session_id], ['confirm' => __('本当に 『' . "$session_name" . '』さんのアカウントを削除しますか？', $session_id), 'class' => 'side-nav-item']) ?>
			<!?= $this->Html->link(__('ユーザーリスト'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
			<!?= $this->Html->link(
				__('口コミ投稿'),
				[
					'controller' => 'Reviews',
					'action' => 'add',
				],
				['class' => 'side-nav-item']
			) ?>
		</div>
	</aside> -->
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>

<div class="column-responsive column-80">
	<div class="grid view content">
		<?php
		$avatar = $user->avatar;
		echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
		?>
		<h3 class="username"><?= h($user->username) ?>さん</h3>
		<p class="gender"><span class="label"><?= __('性別') ?></span> <?= h($user->gender) ?></p>


		<p class="disease">
			<span class="label"><?= __('病名') ?></span>
			<?= $user->has('disease_category') ? $this->Html->link($user->disease_category->name, ['controller' => 'DiseaseCategories', 'action' => 'view', $user->disease_category->id]) : '' ?>
		</p>

		<p class="age">
			<span class="label"><?= __('年齢') ?></span>
			<?= $this->Number->format($user->age) ?>
		</p>

		<p class="created">
			<span class="label"><?= __('登録日時') ?></span>
			<?= h($user->created->format('Y年m月d日 H時i分s秒')) ?>
		</p>

		<div class="user_config">
			<?= $this->Html->link(
				__('プロフィール編集'),
				['action' => 'edit', $session_id],
				['class' => 'link_button']
			) ?>

			<?= $this->Html->link(
				__('口コミ投稿'),
				[
					'controller' => 'Reviews',
					'action' => 'add',
				],
				['class' => 'link_button']
			) ?>

			<?= $this->Form->postLink(
				__('アカウントを削除する'),
				['action' => 'delete', $session_id],
				['class' => 'link_button'],
				['confirm' => __('本当に 『' . "$session_name" . '』さんのアカウントを削除しますか？', $session_id), 'class' => 'side-nav-item']
			) ?>
		</div>

		<div class="head_wrapper">
			<h4 class="review_head"><?= __('口コミ履歴') ?></h4>
		</div>

		<?php if (!empty($user->reviews)) : ?>
			<div class="reviews-gridcontainer">
				<?php foreach ($user->reviews as $reviews) : ?>
					<article class="artcle_area">
						<h3 class="clinic_name tooltip">
							<?= $this->Html->link($query[$reviews->clinic_id], ['controller' => 'Clinics', 'action' => 'view', $reviews->clinic_id]) ?>
							<div class="tooltip_txt">
								<?= $query[$reviews->clinic_id] ?>
							</div>
						</h3>
						<!-- clinicsの配列からidで取得-->
						<?php $content = $reviews->text; ?>
						<p class="text"><?= $this->Html->link(mb_strimwidth($content, 0, 40, '…', 'UTF-8'), ['controller' => 'Reviews', 'action' => 'view', $reviews->id]) ?></p>
						<p class="review_created"><?= h($reviews->created->format('Y年m月d日 H時i分')) ?></p>
						<?= $this->Html->link(
							__('編集'),
							['controller' => 'Reviews', 'action' => 'edit', $reviews->id],
							['class' => 'link_button']
						) ?>
						<?= $this->Form->postLink(
							__('削除'),
							['controller' => 'Reviews', 'action' => 'delete', $reviews->id],
							['class' => 'link_button'],
							['confirm' => __('本当にこの口コミを削除しますか?', $reviews->id)]
						) ?>
					</article>

				<?php endforeach; ?>
			</div>
	</div>
<?php endif; ?>
</div>
</div>
</div>