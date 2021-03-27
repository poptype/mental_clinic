<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiseaseCategory $diseaseCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diseaseCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diseaseCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Disease Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diseaseCategories form content">
            <?= $this->Form->create($diseaseCategory) ?>
            <fieldset>
                <legend><?= __('Edit Disease Category') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
