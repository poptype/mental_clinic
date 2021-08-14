<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'メンタルクリニック　コメントサイト';
?>
<!DOCTYPE html>
<html>

<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= $cakeDescription ?>:
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

	<?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<?= $this->fetch('script') ?>
</head>

<body style="background: url(/mental_clinic/webroot/img/forest-3801537_1920.jpg) var(--background-color)  repeat-x 0 0 fixed;">
	<nav class="top-nav">
		<?= $this->Html->image("tree_and_word_2.svg", ['class' => 'logo_title']) ?>
		<!-- <svg class="nav-titleLogo" xmlns="http://www.w3.org/2000/svg" width="186" height="45" viewBox="0 0 186 45">
				<g id="titleLogo" transform="translate(-181 2)">
					<g id="長方形_3" data-name="長方形 3" transform="translate(181)" fill="#fff" stroke="#707070" stroke-width="1">
						<rect width="186" height="37" stroke="none" />
						<rect x="0.5" y="0.5" width="185" height="36" fill="none" />
					</g>
					<text id="TitleLogo-2" data-name="TitleLogo" transform="translate(202 30)" fill="#707070" font-size="30" font-family="Meiryo">
						<tspan x="0" y="0">TitleLogo</tspan>
					</text>
				</g>
			</svg> -->


		<?= $this->element('seach_menu') ?>
		<?= $this->element('drop_list') ?>

		<?php
		$session = $this->getRequest()->getSession(); //session取得
		$auth_id = $session->read('Auth.id'); //Auth.id取得
		$auth_username = $session->read('Auth.username'); //Auth.username取得
		if (is_null($auth_id)) : ?>
			<a class="nav-login" target="_self" rel="noopener" href="/mental_clinic/users/login">Login</a>
		<?php else : ?>
			<a class="nav-userName" target="_self" rel="noopener" href=<?php echo "/mental_clinic/users/view/" .  "$auth_id" ?>> <?= $auth_username ?></a> <!-- login username to view.php -->
			<a class="nav-logout" target="_self" rel="noopener" href="/mental_clinic/users/logout">logout</a>
		<?php endif ?>
	</nav>
	<main class="main">
		<div class="container">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</div>
	</main>
	<footer>
		<p class="copyright">Copyright © 2021 ○○○○ All Rights Reserved.</p>
	</footer>

	<script>
		document.addEventListener('click', (e) => {
			if (!e.target.closest('.open-btn')) {
				//ここに外側をクリックしたときの処理
				$(this).removeClass('btnactive');
				console.log("ggggggggg")
			} else {
				//ここに内側をクリックしたときの処理
				$(this).toggleClass('btnactive'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
				$("#search-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
				$('#search-text').focus(); //テキスト入力のinputにフォーカス
			}
		})
		//開閉ボタンを押した時には
		// $(".open-btn").click(function() {
		// 	$(this).toggleClass('btnactive'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
		// 	$("#search-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
		// 	$('#search-text').focus(); //テキスト入力のinputにフォーカス
		// });
	</script>
</body>