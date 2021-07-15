<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic[]|\Cake\Collection\CollectionInterface $clinics
 */
// clinic_list.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'clinic_list']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => '病院リスト', 'url' => null]
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

		<h4 class='sort'>並び替え</h4>
		<div class="sort-wrapper">
			<!-- <!?= $this->Paginator->sort('id') ?> -->
			<?= $this->Paginator->sort('病院名') ?>
			<!-- <!?= $this->Paginator->sort('created') ?> -->
			<!-- <!?= $this->Paginator->sort('modified') ?> -->
			<?= $this->Paginator->sort('住所') ?>
			<?= $this->Paginator->sort('最寄り駅') ?>
			<!-- <!?= $this->Paginator->sort('time') ?> -->
			<?= $this->Paginator->sort('電話番号') ?>
		</div>


		<div class="flex_container">
			<?php foreach ($clinics as $clinic) : ?>
				<div class="clinic_list">
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