<?php

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

// top.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'top']));
// getting object
$query = $disease_categories->find('list')->toArray(); //disease_categoriesテーブルから連想配列で取得
?>
<!-- Hero and Guidline  -->
<section class="hero-wrapper">
	<p>HERO and GUIDELINE</p>
</section>
<!--END Hero and Guideline -->
<!-- reviews -->
<section class="reviews">
	<!-- sort -->
	<div class="sort-wrapper">
		<?= $this->Paginator->sort('created', '日付順', ["class" => "sort-label"]) ?>
		<?= $this->Paginator->sort('voting', '投稿順', ["class" => "sort-label"]) ?>
		<?= $this->Paginator->sort('rating', '評点順', ["class" => "sort-label"]) ?>
		<?= $this->Paginator->sort('Users.username', 'ユーザーネーム', ["class" => "sort-label"]) ?>
		<?= $this->Paginator->sort('Clinics.name', '病院名', ["class" => "sort-label"]) ?>
	</div>
	<!--END sort -->
	<article>
		<?php foreach ($reviews as $review) : ?>
			<div class="review-container">
				<?php if (empty($review->clinic->image)) {
					echo $this->Html->image("upload/no-image.jpg", ['alt' => 'clinic image', 'class' => 'thumbnail']);
				} else {
					$image = $review->clinic->image;
					echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'thumbnail']);
				} ?>
				<h3 class="clinic-name">
					<?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?>
				</h3>
				<div class="Stars" style="--rating: <?= $review->rating ?>;" aria-label="Rating of this product.">
					<?= $review->rating ?>
				</div>
				<span class="disease_name ">
					<p class="label_2">
						<?= $review->has('user') ? $query[$review->user->disease_categorie_id] : '' #連想配列にidをkeyとして病名を表示
						?></p>
				</span>
				<p class="body">
					<?php $content = $review->text;
					echo mb_strimwidth($content, 0, 211, '…', 'UTF-8');
					?>

				</p>
				<span class="view_link">
					<?= $this->Html->link(__('続きを読む'), ['controller' => 'Reviews', 'action' => 'view', $review->id]) ?>
				</span>
				<span class="username">
					<?= $review->has('user') ? $this->Html->link($review->user->username, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?>
				</span>
				<span class="created"><?= h($review->created->format('Y年m月d日 H時i分')) ?></span>
				<span class="voting">
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
					<span class="voting_num"><?= $this->Number->format($review->voting) ?></span>
					<!-- <!?php #votingの変数個を☆icon表示
						$num = 0;
						while ($num < $this->Number->format($review->voting)) : ?>
							<!?php if ($num > 10) {
								echo '……';
								break;
							} ?>
							<i class="star"><!?= $this->Html->image("Icon_awesome-heart.svg") ?></i>
						<!?php $num++;
						endwhile;
						?> -->
				</span>
			</div>
		<?php endforeach; ?>
	</article>
	<?= $this->element('paginator') ?>
</section>
<!--END reviews-->