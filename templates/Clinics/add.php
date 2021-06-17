<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
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
			<?= $this->Form->create($clinic, ['type'=>'file']) ?>
			<fieldset>
				<legend><?= __('Add Clinic') ?></legend>
				<?php
				echo $this->Form->control('name');
				echo $this->Form->control('address');
				echo $this->Form->control('station');
				echo $this->Form->control('time');
				echo $this->Form->control('phone_number');
				echo $this->Form->control('image_file', ['type'=>'file']);
				?>
			</fieldset>
			<?= $this->Form->button(__('Submit')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>