<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
// --clinicsテーブルから配列でエンティティを取得　＊スコープの関係上 $clinicsはここでqueryオブジェクトに変換-- /
$query = $clinics->find('list')->toArray();
// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('プロフィール編集'), ['action' => 'edit', $session_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('アカウントを削除する'), ['action' => 'delete', $session_id], ['confirm' => __('本当に 『'. "$session_name". '』さんのアカウントを削除しますか？', $session_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('ユーザーリスト'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(
                __('口コミ投稿'),
                ['controller' => 'Reviews',
                'action' => 'add',
                $session_id],
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
                            <th><?= __('感想') ?></th>
                            <th><?= __('投票') ?></th>
                            <th><?= __('投稿日') ?></th>
                            <th><?= __('編集日') ?></th>
                            <th><?= __('病院名') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->reviews as $reviews) : ?>
                        <tr>
                            <td><?= $this->Html->link($reviews->text, ['controller' => 'Reviews', 'action' => 'view', $reviews->id]) ?></td>
                            <td><?= h($reviews->voting) ?></td>
                            <td><?= h($reviews->created) ?></td>
                            <td><?= h($reviews->modified) ?></td>
                            <td><?= $this->Html->link($query[$reviews->clinic_id], ['controller' => 'Clinics', 'action' => 'view', $reviews->clinic_id]) ?></td> <!-- clinicsの配列からidで取得-->
                            <td class="actions">
                                <?= $this->Html->link(__('編集'), ['controller' => 'Reviews', 'action' => 'edit', $reviews->id]) ?>
                                <?= $this->Form->postLink(__('削除'), ['controller' => 'Reviews', 'action' => 'delete', $reviews->id], ['confirm' => __('本当にこの口コミを削除しますか?', $reviews->id)]) ?>
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
