<div class="list_wrapper" tabindex="1">
	<!-- <svg class="nav-list" id="format_list_bulleted_black_24dp" xmlns="http://www.w3.org/2000/svg" width="28" height="43" viewBox="0 0 28 43">
		<text id="_Caption" data-name="✏️ Caption" transform="translate(13 40)" fill="rgba(0,0,0,1)" font-size="12" font-family="Roboto-Regular, Roboto" letter-spacing="0.033em">
			<tspan x="-10.338" y="0">List</tspan>
		</text>
		<path id="パス_3" data-name="パス 3" d="M0,0H28V28H0Z" fill="none" />
		<path id="path_4" data-name="パス 4" d="M4.25,11.5A1.75,1.75,0,1,0,6,13.25,1.748,1.748,0,0,0,4.25,11.5Zm0-7A1.75,1.75,0,1,0,6,6.25,1.748,1.748,0,0,0,4.25,4.5Zm0,14A1.75,1.75,0,1,0,6,20.25,1.755,1.755,0,0,0,4.25,18.5Zm3.5,2.917H24.083V19.083H7.75Zm0-7H24.083V12.083H7.75Zm0-9.333V7.417H24.083V5.083Z" transform="translate(0.417 0.75)" fill="#9a5cf4" />
	</svg> -->
	<svg class="nav-list" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
		<g id="format_list_bulleted_black_24dp" transform="translate(3 3)">
			<g id="楕円形_3" data-name="楕円形 3" transform="translate(-3 -3)" fill="#e0edfa" stroke="#707070" stroke-width="1">
				<circle cx="18" cy="18" r="18" stroke="none" />
				<circle cx="18" cy="18" r="17.5" fill="none" />
			</g>
			<path id="パス_3" data-name="パス 3" d="M0,0H28V28H0Z" transform="translate(0 3)" fill="none" />
			<path id="パス_4" data-name="パス 4" d="M4.25,11.5A1.75,1.75,0,1,0,6,13.25,1.748,1.748,0,0,0,4.25,11.5Zm0-7A1.75,1.75,0,1,0,6,6.25,1.748,1.748,0,0,0,4.25,4.5Zm0,14A1.75,1.75,0,1,0,6,20.25,1.755,1.755,0,0,0,4.25,18.5Zm3.5,2.917H24.083V19.083H7.75Zm0-7H24.083V12.083H7.75Zm0-9.333V7.417H24.083V5.083Z" transform="translate(1.417 1.75)" fill="#667073" />
		</g>
	</svg>

	<div id="list-wrap">
		<span class="batsu"></span>
		<span>
			<?= $this->Html->link(
				__('ユーザーリスト'),
				['controller' => 'Users', 'action' => 'index'],
				['class' => 'list_anchor']
			) ?><br>
			<?= $this->Html->link(
				__('病院リスト'),
				['controller' => 'Clinics', 'action' => 'list'],
				['class' => 'list_anchor']
			) ?>
		</span>
	</div>
</div>