// init Masonry
var $grid = $('.grid').masonry({
	percentPosition: true,
	columnWidth: 150,
	itemSelector: '.grid-item',
	gutter: 20,
	fitWidth: true,             //コンテンツ数に合わせ親の幅を自動調整
});

// layout Masonry after each image loads
$grid.imagesLoaded().progress(function() {
	$grid.masonry('layout');
});