<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiseaseCategory[]|\Cake\Collection\CollectionInterface $diseaseCategories
 */
?>
<div class="diseaseCategories index content">
    <?= $this->Html->link(__('病名入力'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Disease Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diseaseCategories as $diseaseCategory): ?>
                <tr>
                    <td><?= $this->Number->format($diseaseCategory->id) ?></td>
                    <td><?= h($diseaseCategory->name) ?></td>
                    <td><?= h($diseaseCategory->created) ?></td>
                    <td><?= h($diseaseCategory->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $diseaseCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diseaseCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diseaseCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diseaseCategory->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
