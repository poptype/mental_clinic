<?php
// top.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'top']));
?>
<div class="top-gredContainer">
    <!-- Hero and Guidline  -->
    <section class="hero-wrapper">
        <p>HERO and GUIDELINE</p>
    </section>

    <div class="sort-wrapper">
        <?= $this->Paginator->sort('created', '日付順') ?>
        <?= $this->Paginator->sort('voting', '投稿順') ?>
    </div>
</div>