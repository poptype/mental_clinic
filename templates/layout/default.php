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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
	<?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<?= $this->fetch('script') ?>
</head>

<body>
	<nav class="top-nav">
		<a class="logo" href="/mental_clinic/"><?= $this->Html->image("tree_and_word_2.svg", ['class' => 'logo_title']) ?></a>
		<div class="menu_item_wrap">
			<?= $this->element('seach_menu') ?>
			<?= $this->element('drop_list') ?>

			<?php
			// session reading section
			$session = $this->getRequest()->getSession(); //session取得
			$auth_id = $session->read('Auth.id'); //Auth.id read
			$auth_username = $session->read('Auth.username'); //Auth.username read
			$auth_avatar = $session->read('Auth.avatar'); //Auth.avatar read

			if (is_null($auth_id)) : ?>
				<a class="nav-login" target="_self" rel="noopener" href="/mental_clinic/users/login">Login</a>
			<?php else : ?>
				<a class="nav-userName tooltip" target="_self" rel="noopener" href=<?php echo "/mental_clinic/users/view/" .  "$auth_id" ?>>
					<?php if (is_null($auth_avatar)) {
						echo $this->Html->image("upload/blank-profile.png", ['alt' => 'avatar image', 'class' => 'nav-avatar']);
					} else {
						echo $this->Html->image("upload/${auth_avatar}", ['alt' => 'clinic image', 'class' => 'nav-avatar']);
					} ?>
					<span class="tooltip_txt"><?= $auth_username ?>さん</span>
				</a> <!-- login username to view.php -->
				<a class="nav-logout" target="_self" rel="noopener" href="/mental_clinic/users/logout">Logout</a>
			<?php endif ?>
		</div>
	</nav>
	<main class="main">
		<div class="container">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</div>
		<div id="page_top"><a href="#"></a></div>
	</main>
	<footer>
		<p class="copyright">Copyright © 2021 ○○○○ All Rights Reserved.</p>
	</footer>
	<script src="/mental_clinic/webroot/js/pageTop_return_button.js"></script>
	<script src="/mental_clinic/webroot/js/list_button.js"></script>
</body>