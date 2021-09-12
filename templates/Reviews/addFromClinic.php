<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
?>
<?php
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('レビューの一覧'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reviews form content">
            <?= $this->Form->create($review) ?>
            <fieldset>
                <legend><?= __('口コミ投稿') ?></legend>
                <?php
                    echo $this->Form->control('text', ['label' => '感想']);
                    echo $this->Form->control('voting', ['label' => '投稿']);
                    echo $this->Form->control('rating', ['label' => '評点']);
                    echo $this->Form->hidden("user_id", ['value' => $user_id ]);
                    echo $this->Form->hidden('病院名', ['value' => $clinic_id]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('投稿')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
