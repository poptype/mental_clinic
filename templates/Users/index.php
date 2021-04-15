<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('新規ユーザー登録'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('ユーザーリスト') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('アカウント名') ?></th>
                    <th><?= $this->Paginator->sort('性別') ?></th>
                    <th><?= $this->Paginator->sort('年齢') ?></th>
                    <th><?= $this->Paginator->sort('登録日') ?></th>
                    <th><?= $this->Paginator->sort('編集日') ?></th>
                    <th><?= $this->Paginator->sort('病名') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th class="actions"><?= __('') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?>
</td>
                    <td><?= h($user->gender) ?></td>
                    <td><?= $this->Number->format($user->age) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td><?= $user->has('disease_category') ? $this->Html->link($user->disease_category->name, ['controller' => 'DiseaseCategories', 'action' => 'view', $user->disease_category->id]) : '' ?></td>
                    <td><?= h($user->email) ?></td>
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
