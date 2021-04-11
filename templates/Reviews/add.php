<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
?>
<?php

$this->start("script");
      echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
      echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
$this->end();

$this->assign('css', '<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">');
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
                    echo $this->Form->control('感想');
                    echo $this->Form->control('投稿');
                    echo $this->Form->hidden("user_id", ['value' => $user_id ]);
                    echo $this->Form->control('病院名', ['id' => 'autocomplete']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('投稿')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
void function autocomplete(undefined) {

    var availableTags = <?= $suggestWordJson ?>;//controlからレコードを変換したJsonオブジェクトを代入

    $("#autocomplete").autocomplete({
        source: Object.values(availableTags), //Objectから連想配列を抽出してパラメータに指定
        autoFocus: true,
        delay: 500,
        minLength: 1
    });

}(undefined);
</script>













