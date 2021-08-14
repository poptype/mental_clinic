<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

// --sessionからログイン情報取得 -- //
$session_id = $this->getRequest()->getSession()->read('Auth.id');
$session_name = $this->getRequest()->getSession()->read('Auth.username');

$query = $diseaseCategories->find('list')->toArray();

// post.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'confirm']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => 'ユーザーリスト', 'url' => ['controller' => 'Users', 'action' => 'index']],
	['title' => '確認画面']
]);

echo $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>

<div class="column-responsive column-80">
	<div class=" users form content">
		<?= $this->Form->create($user, ['type' => 'post', ['controller' => 'Users', 'action' => 'complete']]) ?>
		<fieldset class="grid">
			<h3 class='heading heading_line'><?= __('入力情報の確認') ?></h3>
			<div class="avatar_wrapper">
				<?php if (empty($user->avatar)) {
					echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'avatar']);
				} else {
					$avatar = $user->avatar;
					echo $this->Html->image("upload/${avatar}", ['alt' => 'clinic image', 'class' => 'avatar']);
				} ?>
			</div>
			<!-- <!?= $this->Form->control('username', ['label' => 'アカウント名', 'div' => false]) ?> -->
			<label class='label_username'>アカウント名</label>
			<span class="username"><?= $user->username ?></span>
			<label class = 'label_password'>パスワード</label>
			<span class="password"><?= h($password) //暗号化前のパスワードを表示?></span>


			<!-- echo $this->Form->control('gender', [
'options' => [
['value' => '男', 'text' => '男'],
['value' => '女', 'text' => '女']
],
'label' => ['text' => '性別']
]); -->

			<label class='label_gender'>性別</label>
			<span class="gender"><?= $user->gender ?></span>
			<label class='label_age'>年齢</label>
			<span class="age"><?= $user->age ?></span>
			<label class ='label_diseage_name'>病名</label>
			<span class="diseage_name"><?= $query[$user->disease_categorie_id] ?></span>
			<label class ='label_email'>Email</label>
			<span class="email"><?= $user->email ?></span>
			<?= $this->Form->button(__('登録完了'), ['type' => 'submit']) ?>

		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div>