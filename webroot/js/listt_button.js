void
function list_button(undefined) {
	// document.addEventListener('click', (e) => {
	// 	if (!e.target.closest('.open-btn')) {
	// 		//ここに外側をクリックしたときの処理
	// 		$(this).removeClass('btnactive');
	// 		console.log("ggggggggg")
	// 	} else {
	// 		//ここに内側をクリックしたときの処理
	// 		$(this).toggleClass('btnactive'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
	// 		$("#search-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
	// 		$('#search-text').focus(); //テキスト入力のinputにフォーカス
	// 	}
	// })
	//開閉ボタンを押した時には
	$(".open-btn").click(function () {
		$(this).toggleClass('btnactive_1'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
		$("#search-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
		$('#search-text').focus(); //テキスト入力のinputにフォーカス
		$("#list-wrap").removeClass('panelactive');
		$(".nav-list").removeClass('btnactive_2');
	});

	//開閉ボタンを押した時には
	$(".nav-list").click(function () {
		$(this).toggleClass('btnactive_2'); //.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
		$("#list-wrap").toggleClass('panelactive'); //#search-wrapへpanelactiveクラスを付与
		$(".open-btn").removeClass('btnactive_1');
		$("#search-wrap").removeClass('panelactive');
	});

	//☓を押した時は
	$(".batsu").click(function () {
		$(".open-btn").removeClass('btnactive_1');
		$(".nav-list").removeClass('btnactive_2');
		$("#search-wrap").removeClass('panelactive');
		$("#list-wrap").removeClass('panelactive');
	});
}(undefined);