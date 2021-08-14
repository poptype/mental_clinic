<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
?>
<?php

$this->start("script");
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
$this->end();
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<?php
// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => "プロフィール", 'url' => ['controller' => 'Users', 'action' => "view/{$user_id}"]],
	['title' => '口コミ投稿']
]);
echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);

?>

<!-- <aside class="column">
		<div class="side-nav">
			<h4 class="heading"><!?= __('Actions') ?></h4>
			<!?= $this->Html->link(__('レビューの一覧'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
		</div>
	</aside> -->
<div class="review_add column-responsive column-80">
	<h1><?= __('口コミ投稿') ?></h1>
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
			<?= $this->Form->hidden("user_id", ['value' => $user_id]); ?>
			<?= $this->Form->control('clinic_id', [
				'type' => 'text', //typeを指定しないとselectになってしまってautocompleteが機能しなくなる。
				'id' => 'autocomplete',
				'label' => '病院名',
				'placeholder' => '文字を入力すると病院名を自動補完します'
			]); ?>
		</fieldset>
		<?= $this->Form->button(__('投稿')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>

<script>
	void

	function autocomplete(undefined) {

		var availableTags = <?= $suggestWordJson ?>; //controlからレコードを変換したJsonオブジェクトを代入

		$("#autocomplete").autocomplete({
			source: Object.values(availableTags), //Objectから連想配列を抽出してパラメータに指定
			autoFocus: true,
			delay: 500,
			minLength: 1
		});

	}(undefined);

	void

	function input_range(undefined) {
		let elem = document.getElementById('range');
		let target = document.getElementById('value');
		let rangeValue = function(elem, target) {
			return function(evt) {
				target.innerHTML = elem.value + "点";
			}
		}
		elem.addEventListener('input', rangeValue(elem, target));
	}(undefined);
</script>