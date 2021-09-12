<div class="paginator">
	<ul class="pagination">
		<?= $this->Paginator->first('<< ') ?>
		<?= $this->Paginator->prev(__('前')) ?>
		<?= $this->Paginator->numbers(['modulus' => 4, 'after' => '…']) ?>
		<?= $this->Paginator->next(__('次')) ?>
		<?= $this->Paginator->last(' >>') ?>
		<li class="page_count"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}')) ?></li>
	</ul>
	<!--<p><!?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>-->
</div>