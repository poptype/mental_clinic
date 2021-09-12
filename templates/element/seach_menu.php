		<!-- <svg class="open-btn" xmlns="http://www.w3.org/2000/svg" width="45" height="43" viewBox="0 0 40 40">
			<g id="Light_Bottom_Nav_Tab_on_Primary" data-name="Light 🌕/ Bottom Nav/Tab on Primary" transform="translate(-25 -8)">

				<text id="_Caption" data-name="✏️ Caption" transform="translate(45 45)" fill="rgba(0,0,0,1)" font-size="12" font-family="Roboto-Regular, Roboto" letter-spacing="0.033em">
					<tspan x="-19.422" y="0">Search</tspan>
				</text>
				<g id="icon_action_search_24px" data-name="icon/action/search_24px" transform="translate(33 8)" opacity="0.601">
					<rect id="Boundary" width="24" height="24" fill="none" />
					<path id="_Color" data-name=" ↳Color" d="M16.467,18h0l-5.146-5.134v-.813l-.278-.288a6.7,6.7,0,1,1,.721-.721l.288.278h.813L18,16.467,16.468,18ZM6.689,2.058a4.631,4.631,0,1,0,4.631,4.631A4.637,4.637,0,0,0,6.689,2.058Z" transform="translate(3 3)" fill="#9a5cf4" />
				</g>
			</g>
		</svg> -->
		<svg class="open-btn" tabindex="0" mlns="http://www.w3.org/2000/svg" width="36" height="37" viewBox="0 0 36 37">
			<g id="icon_action_search_24px" data-name="icon/action/search_24px" transform="translate(5 0.102)" opacity="0.601">
				<g id="楕円形_2" data-name="楕円形 2" transform="translate(-5 0.898)" fill="#cbe2f7" stroke="#707070" stroke-width="1">
					<circle cx="18" cy="18" r="18" stroke="none" />
					<circle cx="18" cy="18" r="17.5" fill="none" />
				</g>
				<rect id="Boundary" width="27" height="27" transform="translate(0 -0.102)" fill="none" />
				<path id="_Color" data-name=" ↳Color" d="M19.212,21h0l-6-5.99V14.06l-.324-.336a7.815,7.815,0,1,1,.841-.841l.336.324h.949l5.991,6L19.212,21ZM7.8,2.4a5.4,5.4,0,1,0,5.4,5.4A5.409,5.409,0,0,0,7.8,2.4Z" transform="translate(3 8.898)" fill="#001217" />
			</g>
		</svg>


		<div id="search-wrap">
			<span class="batsu"></span>
			<?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Reviews', 'action' => 'top']]) ?>
			<?= $this->Form->control('key', [
				'label' => '検索',
				'value' => $this->request->getQuery('key'),
				'placeholder' => '病院またはユーザーを検索'
			]) ?>
			<?= $this->Form->submit('', ["class" => 'list_submit_img postion']) ?>
			<?= $this->Form->end() ?>
		</div>