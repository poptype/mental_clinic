<?php

/**
 * voting incriment method
 *
 * @param Object|reviewsObject $review reviewのインスタンス
 * @return int: incrimentした変数$num 投票ボタンを押すとインクリメントしてpostするため（変数に入れ直さないと動かなかった）
 */
function voting_incr($review)
{
    $num = $review->voting + 1;
    return $num;
}
// top.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'top']));
//disease_categoriesテーブルから連想配列で取得
$query = $disease_categories->find('list')->toArray();
?>
<!-- Hero and Guidline  -->
<section class="hero-wrapper">
    <p>HERO and GUIDELINE</p>
</section>
<!--END Hero and Guideline -->
<!-- reviews -->
<section class="reviews">
    <!-- sort -->
    <div class="sort-wrapper">
        <?= $this->Paginator->sort('created', '日付順') ?>
        <?= $this->Paginator->sort('voting', '投稿順') ?>
    </div>
    <!--END sort -->
    <article>
        <?php foreach ($reviews as $review) : ?>
            <div class="review-container">
                <h3 class="clinic-name">
                    <?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?>
                </h3>
                <span class="disease_name">
                    <?= $review->has('user') ? $this->Html->link($query[$review->user->disease_categorie_id], ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' #連想配列にidをkeyとして病名を表示
                    ?>
                </span>
                <p class="body"><?= h($review->text) ?></p>
                <span class="username">
                    <?= $review->has('user') ? $this->Html->link($review->user->username, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?>
                </span>
                <span class="created"><?= h($review->created->format('Y年m月d日 H時i分s秒')) ?></span>
                <span class="voting">
                    <?= $this->Form->create($review) ?>
                    <fieldset>
                        <?php
                        echo $this->Form->hidden('voting', ['value' => voting_incr($review)]);
                        echo $this->Form->hidden('id');#review_idもpost
                        ?>
                    </fieldset>
                    <?= $this->Form->button('', array(
			    'class' => 'voting_image',
			    'div' => false)
		    );
		    ?>
                    <?= $this->Form->end() ?>
		    <div>
			    <p>いいね！</p>
                    <?php #votingの変数個を☆icon表示
                    $num = 0;
                    while ($num < $this->Number->format($review->voting)) : ?>
                        <i class="star"><?= $this->Html->image("Icon_awesome-heart.svg") ?></i>
                    <?php $num++;
                    endwhile;
                    ?>
		    </div>
                </span>
            </div>
        <?php endforeach; ?>
    </article>
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
</section>
<!--END reviews-->