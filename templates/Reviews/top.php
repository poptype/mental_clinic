<?php
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
            <?= $review->has('clinic') ? $this->Html->link($review->clinic->name, ['controller' => 'Clinics', 'action' => 'view', $review->clinic->id]) : '' ?>
            <?= $review->has('user') ? $this->Html->link($query[$review->user->disease_categorie_id], ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' #連想配列にidをkeyとして病名を表示?>
            <?= h($review->text) ?>
            <!--?=// $this->Number->format($review->id) ?-->
            <?= $review->has('user') ? $this->Html->link($review->user->username, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?>
            <?= h($review->created) ?>
            <?= $this->Number->format($review->voting) ?>
            <!--?=// h($review->modified) ?-->
            <!--?=// $this->Html->link(__('View'), ['action' => 'view', $review->id]) ?-->
            <!--?=// $this->Html->link(__('Edit'), ['action' => 'edit', $review->id]) ?-->
            <!--?=// $this->Form->postLink(__('Delete'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?-->
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