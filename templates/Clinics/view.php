<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
// getting object
$query = $users->find('list')->toArray(); //usersテーブルから連想配列で取得
$image = $clinic->image;
//clinic im// clinic.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'clinic']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => $clinic->name, 'url' => null]
]);
?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>

<div class="column-responsive column-80">
	<div class="grid content">
		<h3><?= h($clinic->name) ?></h3>
		<p class="reviews"><i class="reviews_icon"></i><span>口コミ<b><?= count($clinic->reviews) ?></b>件</span></p>
		<div class="Stars" style="--rating: <?= $clinic->rating ?>;" aria-label="Rating of this product.">
			<?= $clinic->rating ?>
		</div>
		<?php if (is_null($clinic->image)) {
			echo $this->Html->image("upload/no-image.jpg", ['alt' => 'clinic image', 'class' => 'clinic_img']);
		} else {
			echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'clinic_img']);
		} ?>
		<p class="station">
			<?= $this->Html->image('icon_station.svg', ['alt' => 'icon of station']) ?>
			<span class="label">最寄り駅</span>　<?= h($clinic->station) ?>　<?= h($clinic->time) ?>
		</p>
		<p class="address">
			<?= $this->Html->image('icon_address.svg', ['alt' => 'icon of address']) ?>
			<span class="label">住所</span>　<?= h($clinic->address) ?>
		</p>
		<p class="phone_number">
			<?= $this->Html->image('icon_phoneNumber.svg', ['alt' => 'icon of phone number']) ?>
			<span class="label">電話番号</span>　
			<?php if (empty($clinic->phone_number)) : ?>
				なし
			<?php else : ?>
				<?= h($clinic->phone_number) ?>
			<?php endif; ?>
		</p>
		<div class="related">
			<h4><?= h($clinic->name) ?>の<?= __('口コミ') ?></h4>
			<?php if (!empty($clinic->reviews)) : ?>
				<div class="table-responsive">
					<article class="article_grid">
						<?php foreach ($clinic->reviews as $reviews) : ?>

							<p class="username">
								<?= $this->Html->link($query[$reviews->user_id],
								['controller' => 'Users', 'action' => 'view', $reviews->user_id],
								['class' => 'label']) ?>さんの口コミ
								<?= h($reviews->created->format('Y年m月d日 H時i分s秒')) ?>
							</p>
							<?php $content = $reviews->text; ?>
							<?= $this->Html->link(
								mb_strimwidth($content, 0, 50, '…', 'UTF-8'),
								['controller' => 'Reviews', 'action' => 'view', $reviews->id]
							) ?>

					</article>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>