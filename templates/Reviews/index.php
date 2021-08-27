<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review[]|\Cake\Collection\CollectionInterface $reviews
 */
$session_id = $this->getRequest()->getSession()->read('Auth.id');
?>
<div class="reviews index content">
    <?= $this->Html->link(__('口コミ投稿'), ['action' => 'add', $session_id], ['class' => 'button float-right']) ?>

    <h3><?= __('Reviews') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('voting') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('clinic_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review) : ?>
                <tr>
                    <td><?= $this->Number->format($review->id) ?></td>
                    <td><?= $this->Number->format($review->voting) ?></td>
                    <td><?= h($review->created) ?></td>
                    <td><?= h($review->modified) ?></td>
                    <td><?= $review->has('user') ? $this->Html->link($review->user->id, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?></td>
                    <td><?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $review->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $review->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?>
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
