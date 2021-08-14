<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */

// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => "プロフィール", 'url' => ['controller' => 'Clinics', 'action' => "list"]],
	['title' => '口コミ編集']
]);
echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);

?>

<div class="review_add column-responsive column-80">
	<h1><?= __('口コミ編集') ?></h1>
	<div class="reviews form content">
		<?= $this->Form->create($review) ?>
		<fieldset>
			<div id="filter">
				<?= $this->Form->control('rating', [
					'type' => 'range',
					'label' => 'スコア',
					'id'  => 'range',
					'min' => '0',
					'max' => '5',
					'step' => '0.1'
				]); ?>
				<span id="value">0点</span>
			</div>
			<?= $this->Form->control('text', ['label' => '', 'placeholder' => 'あなたの受診したクリニックの感想を書いて下さい（枠の右下斜めをドラッグすると広がります)']); ?>
			<?= $this->Form->button(__('送信')) ?>
			<?= $this->Form->end() ?>
	</div>
</div>

<script>
	void function input_range(undefined) {
		let elem = document.getElementById('range');
		let target = document.getElementById('value');
		let rangeValue = (elem, target) => {
			return (evt) => {
				target.innerHTML = elem.value + "点";
			};
		};
		elem.addEventListener('input', rangeValue(elem, target));
	}(undefined);
</script>