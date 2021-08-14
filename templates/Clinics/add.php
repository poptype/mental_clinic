<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'post']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => '病院リスト', 'url' => ['controller' => 'Clinics', 'action' => 'list']],
	['title' => '病院情報の入力']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
);
?>
<div class="row">
	<aside class="column">
		<div class="side-nav">
			<h4 class="heading"><?= __('Actions') ?></h4>
			<?= $this->Html->link(__('List Clinics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
		</div>
	</aside>
	<div class="column-responsive column-80">
		<div class="clinics form content">
			<?= $this->Form->create($clinic, ['type' => 'file']) ?>
			<fieldset>
				<legend><?= __('Add Clinic') ?></legend>
				<div class="avatar_wrapper">
					<?php if (empty($clinic->image)) {
						echo $this->Html->image("upload/no-image.jpg", ['alt' => 'avatar image', 'class' => 'clinic_img']);
					} else {
						$image = $clinic->image;
						echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'clinic_img']);
					} ?>

					<?= $this->Form->control('image_file', [
						'type' => 'file',
						'onChange' => 'imgPreView(event)',
						'label' => '変更'
					]); ?>
				</div>
				<?php
				echo $this->Form->control('name');
				echo $this->Form->control('address');
				echo $this->Form->control('station');
				echo $this->Form->control('time');
				echo $this->Form->control('phone_number');
				?>



			</fieldset>
			<?= $this->Form->button(__('Submit')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>

<?php
$this->start("script");
echo $this->Html->script('imgPreView');;
$this->end();
?>