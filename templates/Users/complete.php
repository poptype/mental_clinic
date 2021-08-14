<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');

// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'complete']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => '入力完了']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>
<div class="column-responsive column-80">
<div class=" users form content">
	<h2 class="complete heading_line">登録が完了いたしました。
		<br> ご入力ありがとうございます。
	</h2>

	<button class="label" onclick="location.href='<?= $this->Url->build('/', [
								'escape' => false,
								'fullBase' => true,
							]) ?>'">戻る</button>
</div>
</div>