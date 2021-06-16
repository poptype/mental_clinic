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
        <svg class="nav-serach" xmlns="http://www.w3.org/2000/svg" width="45" height="43" viewBox="0 0 40 40">
            <g id="Light_Bottom_Nav_Tab_on_Primary" data-name="Light 🌕/ Bottom Nav/Tab on Primary" transform="translate(-25 -8)">

                <text id="_Caption" data-name="✏️ Caption" transform="translate(45 45)" fill="rgba(0,0,0,1)" font-size="12" font-family="Roboto-Regular, Roboto" letter-spacing="0.033em">
                    <tspan x="-19.422" y="0">Search</tspan>
                </text>
                <g id="icon_action_search_24px" data-name="icon/action/search_24px" transform="translate(33 8)" opacity="0.601">
                    <rect id="Boundary" width="24" height="24" fill="none" />
                    <path id="_Color" data-name=" ↳Color" d="M16.467,18h0l-5.146-5.134v-.813l-.278-.288a6.7,6.7,0,1,1,.721-.721l.288.278h.813L18,16.467,16.468,18ZM6.689,2.058a4.631,4.631,0,1,0,4.631,4.631A4.637,4.637,0,0,0,6.689,2.058Z" transform="translate(3 3)" fill="#9a5cf4" />
                </g>
            </g>
        </svg>
        <svg class="nav-list" id="format_list_bulleted_black_24dp" xmlns="http://www.w3.org/2000/svg" width="28" height="43" viewBox="0 0 28 43">
            <text id="_Caption" data-name="✏️ Caption" transform="translate(13 40)" fill="rgba(0,0,0,1)" font-size="12" font-family="Roboto-Regular, Roboto" letter-spacing="0.033em">
                <tspan x="-10.338" y="0">List</tspan>
            </text>
            <path id="パス_3" data-name="パス 3" d="M0,0H28V28H0Z" fill="none" />
            <path id="パス_4" data-name="パス 4" d="M4.25,11.5A1.75,1.75,0,1,0,6,13.25,1.748,1.748,0,0,0,4.25,11.5Zm0-7A1.75,1.75,0,1,0,6,6.25,1.748,1.748,0,0,0,4.25,4.5Zm0,14A1.75,1.75,0,1,0,6,20.25,1.755,1.755,0,0,0,4.25,18.5Zm3.5,2.917H24.083V19.083H7.75Zm0-7H24.083V12.083H7.75Zm0-9.333V7.417H24.083V5.083Z" transform="translate(0.417 0.75)" fill="#9a5cf4" />
        </svg>

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
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
	    <p class="copyright">Copyright © 2021 ○○○○ All Rights Reserved.</p>
    </footer>
</body>