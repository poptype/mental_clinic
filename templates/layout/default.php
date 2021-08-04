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

$cakeDescription = 'CakePHP: the rapid development php framework';
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

<body>
	<nav class="top-nav">
		<a href="<?= $this->Url->build('/') ?>">
			<svg class="nav-logo" xmlns="http://www.w3.org/2000/svg" width="132" height="42" viewBox="0 0 132 42">
				<g id="logo" transform="translate(0 -2)">
					<g id="長方形_2" data-name="長方形 2" transform="translate(0 4)" fill="#fff" stroke="#707070" stroke-width="1">
						<rect width="132" height="32" stroke="none" />
						<rect x="0.5" y="0.5" width="131" height="31" fill="none" />
					</g>
					<text id="LOGO-2" data-name="LOGO" transform="translate(20 32)" fill="#707070" font-size="28" font-family="Meiryo">
						<tspan x="0" y="0">LOGO</tspan>
					</text>
				</g>
			</svg>
			<svg class="nav-titleLogo" xmlns="http://www.w3.org/2000/svg" width="186" height="45" viewBox="0 0 186 45">
				<g id="titleLogo" transform="translate(-181 2)">
					<g id="長方形_3" data-name="長方形 3" transform="translate(181)" fill="#fff" stroke="#707070" stroke-width="1">
						<rect width="186" height="37" stroke="none" />
						<rect x="0.5" y="0.5" width="185" height="36" fill="none" />
					</g>
					<text id="TitleLogo-2" data-name="TitleLogo" transform="translate(202 30)" fill="#707070" font-size="30" font-family="Meiryo">
						<tspan x="0" y="0">TitleLogo</tspan>
					</text>
				</g>
			</svg>
		</a>

		<?= $this->element('seach_menu') ?>
		<?= $this->element('drop_list') ?>

		<?php
		$session = $this->getRequest()->getSession(); //session取得
		$auth_id = $session->read('Auth.id'); //Auth.id取得
		$auth_username = $session->read('Auth.username'); //Auth.username取得
		if (is_null($auth_id)) : ?>
			<a target="_self" rel="noopener" href="/mental_clinic/users/login">login</a>
		<?php else : ?>
			<a class="nav-userName" target="_self" rel="noopener" href=<?php echo "/mental_clinic/users/view/" .  "$auth_id" ?>> <?= $auth_username ?></a> <!-- login username to view.php -->
			<a class="nav-logout" target="_self" rel="noopener" href="/mental_clinic/users/logout">logout</a>
		<?php endif ?>
	</nav>
	<main class="main" style="background: url(<?php echo $this->Url->build("/webroot/img") ?>/forest-3801537_1920.jpg) var(--background-color)  repeat-x 0 0 fixed;">
		<div class="container">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</div>
	</main>
	<footer>
		<p class="copyright">Copyright © 2021 ○○○○ All Rights Reserved.</p>
	</footer>

	<script>
		//開閉ボタンを押した時には
		$(".open-btn").click(function() {
			$(this).toggleClass('btnactive'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
			$("#search-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
			$('#search-text').focus(); //テキスト入力のinputにフォーカス
		});
	</script>
</body>