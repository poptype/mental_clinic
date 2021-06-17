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
            <?= $this->Html->link(__('Edit Clinic'), ['action' => 'edit', $clinic->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Clinic'), ['action' => 'delete', $clinic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinic->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clinics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Clinic'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clinics view content">
            <h3><?= h($clinic->name) ?></h3>
	    <?= $this->Html->image($clinic->image, ['alt' => 'textalternatif']) ?>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($clinic->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($clinic->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Station') ?></th>
                    <td><?= h($clinic->station) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time') ?></th>
                    <td><?= h($clinic->time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($clinic->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clinic->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($clinic->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($clinic->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Reviews') ?></h4>
                <?php if (!empty($clinic->reviews)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Text') ?></th>
                            <th><?= __('Voting') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Clinic Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($clinic->reviews as $reviews) : ?>
                        <tr>
                            <td><?= h($reviews->id) ?></td>
                            <td><?= h($reviews->text) ?></td>
                            <td><?= h($reviews->voting) ?></td>
                            <td><?= h($reviews->created) ?></td>
                            <td><?= h($reviews->modified) ?></td>
                            <td><?= h($reviews->user_id) ?></td>
                            <td><?= h($reviews->clinic_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reviews', 'action' => 'view', $reviews->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reviews', 'action' => 'edit', $reviews->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reviews', 'action' => 'delete', $reviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviews->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
