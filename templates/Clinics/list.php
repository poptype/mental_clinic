<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic[]|\Cake\Collection\CollectionInterface $clinics
 */
// clinic_list.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'clinic_list']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => '病院リスト', 'url' => ['controller' => 'Clinics', 'action' => 'list']]
]);

?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
) ?>


<div class="column-responsive column-80">
	<div class="clinics index content">
		<!-- <!?= $this->Html->link(__('New Clinic'), ['action' => 'add'], ['class' => 'button float-right']) ?> -->
		<h3 class="heading"><?= __('病院リスト') ?></h3>

		<h4 class='sort'>並び替え<sub>(各並び替え要素で検索可能)</sub></h4>
		<div class="sort-wrapper">
			<!-- <!?= $this->Paginator->sort('id') ?> -->
			<?= $this->Paginator->sort('name', '病院名') ?>
			<!-- <!?= $this->Paginator->sort('created') ?> -->
			<!-- <!?= $this->Paginator->sort('modified') ?> -->
			<?= $this->Paginator->sort('address', '住所') ?>
			<?= $this->Paginator->sort('station', '最寄り駅') ?>
			<!-- <!?= $this->Paginator->sort('time') ?> -->
			<?= $this->Paginator->sort('phone_number', '電話番号') ?>

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
		</div>


		<!-- <div class="flex_container"> -->
		<div class="grid">
			<?php foreach ($clinics as $clinic) : ?>
				<!-- <div class="clinic_list"> -->
				<div class="grid-item clinic_list">
					<!-- <!?= $this->Number->format($clinic->id) ?> -->
					<h4 class="clinic_name">
						<?= $this->Html->link(
							$clinic->name,
							['action' => 'view', $clinic->id]
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


	</div>
	<?= $this->element('paginator') ?>
</div>
<!-- masonry.js  -->
<?php
$this->start("under_script");
echo '<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>';
echo '<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>';
echo $this->Html->script('masonry');
$this->end();
?>