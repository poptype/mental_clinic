<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
// review.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'review']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => $review->user->username . "さんの口コミ", 'url' => null]
]);
/**
 * voting incriment method
 *
 * @param Object|reviewsObject $review reviewのインスタンス
 * @return int: incrimentした変数$num 投票ボタンを押すとインクリメントしてpostするため（変数に入れ直さないと動かなかった）
 */
function voting_incr($review)
{
	$num = $review->voting + 1;
	return $num;
}
?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>
<div class="column-responsive column-80">
	<div class="grid content">
		<?php if (empty($user->avatar)) {
			echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
		} else {
			$avatar = $user->avatar;
			echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
		} ?>

		<h2 class="title heading_line">
			<?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?>
			の
			<?= $review->has('user') ? $this->Html->link($review->user->username, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?>
			さんの口コミ、感想、レビュー
		</h2>
		<span class="created"><?= h($review->created->format('Y年m月d日 H時i分')) ?></span>
		<!-- <p>
			<!?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?>
			の評価
		</p> -->
		<div class="Stars" style="--rating: <?= $review->rating ?>;" aria-label="Rating of this product.">
			<?= $review->rating ?>
		</div>
		<?php if (empty($review->clinic->image)) {
			echo $this->Html->image("upload/no-image.jpg", ['alt' => 'clinic image', 'class' => 'thumbnail']);
		} else {
			$image = $review->clinic->image;
			echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'thumbnail']);
		} ?>
		<div class="text">
			<blockquote>
				<?= $this->Text->autoParagraph(h($review->text)); ?>
			</blockquote>
		</div>
		<?= $this->Form->create($review) ?>
			<fieldset>
				<?php
				echo $this->Form->hidden('voting', ['value' => voting_incr($review)]);
				echo $this->Form->hidden('id'); #review_idもpost
				?>
			</fieldset>
			<?= $this->Form->button(
				'',
				array(
					'class' => 'voting_image',
					'div' => false
				)
			);
			?>
		<?= $this->Form->end() ?>
					<span class="voting_num img-balloon"><b><?= $this->Number->format($review->voting) ?></b>いいね！</span>

		<div class="voting">

			<?php #votingの変数個を☆icon表示
			$num = 0;
			while ($num < $this->Number->format($review->voting)) : ?>
				<?php if ($num > 10) {
					echo '……';
					break;
				} ?>
				<i class="star"><?= $this->Html->image("Icon_awesome-heart.svg") ?></i>
			<?php $num++;
			endwhile;
			?>
		</div>
	</div>
</div>