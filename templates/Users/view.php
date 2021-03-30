<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('プロフィール編集'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('アカウントを削除する'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('ユーザーリスト'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(
                __('口コミ投稿'),
                ['controller' => 'Reviews',
                'action' => 'add',
                $user->id],
                ['class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3>プロフィール</h3>
            <table>
                <tr>
                    <th><?= __('アカウント名') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('性別') ?></th>
                    <td><?= h($user->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('病名') ?></th>
                    <td><?= $user->has('disease_category') ? $this->Html->link($user->disease_category->name, ['controller' => 'DiseaseCategories', 'action' => 'view', $user->disease_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('年齢') ?></th>
                    <td><?= $this->Number->format($user->age) ?></td>
                </tr>
                <tr>
                    <th><?= __('登録日時') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('変更日時') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('口コミ履歴') ?></h4>
                <?php if (!empty($user->reviews)) : ?>
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
                        <?php foreach ($user->reviews as $reviews) : ?>
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
