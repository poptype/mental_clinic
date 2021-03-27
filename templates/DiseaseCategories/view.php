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
            <?= $this->Html->link(__('Edit Disease Category'), ['action' => 'edit', $diseaseCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Disease Category'), ['action' => 'delete', $diseaseCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diseaseCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Disease Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Disease Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diseaseCategories view content">
            <h3><?= h($diseaseCategory->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($diseaseCategory->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($diseaseCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($diseaseCategory->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($diseaseCategory->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
