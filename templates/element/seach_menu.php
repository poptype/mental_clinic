		<svg class="open-btn" xmlns="http://www.w3.org/2000/svg" width="45" height="43" viewBox="0 0 40 40">
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

		<div id="search-wrap">
			<?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Reviews', 'action' => 'index']]) ?>
			<?= $this->Form->control('key', ['label'=>'検索', 'value' => $this->request->getQuery('key')]) ?>
			<?= $this->Form->submit() ?>
			<?= $this->Form->end() ?>
<!--
			<form role="search" method="get" id="searchform" action="">
				<input type="text" value="" name="" id="search-text" placeholder="search">
				<input type="submit" id="searchsubmit" value="">
			</form> -->
		</div>
		<!--/search-wrap-->