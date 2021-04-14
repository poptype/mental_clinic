<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $review->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $review->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Reviews'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reviews form content">
            <?= $this->Form->create($review) ?>
            <fieldset>
                <legend><?= __('口コミレビューの編集') ?></legend>
                <?php
                    echo $this->Form->control('text', ['label' => '感想']);
                   // echo $this->Form->control('投票', ['name' => 'voting']);
                   // echo $this->Form->control('user_id', ['options' => $users]);
                   /* echo $this->Form->control('病院名', [
                    'options' => $clinics,
                    'name' => 'clinic_id']);*/
                ?>
                </fieldset>
                <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
