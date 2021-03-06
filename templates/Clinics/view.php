<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
// getting object
$query = $users->find('list')->toArray(); //usersテーブルから連想配列で取得
$image = $clinic->image;
//clinic im// clinic.cssの適用
$this->assign('css', $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'clinic']));
$this->Breadcrumbs->add([
	['title' => 'Home', 'url' => '/'],
	['title' => '病院リスト', 'url' => ['controller' => 'Clinics', 'action' => 'list']],
	['title' => $clinic->name, 'url' => ['action' => 'view', $clinic->id]]
]);
$this->start("script");
echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxX8T-0SmlrtYVg1FO3Laj612Ev9RiRaM&callback=initMapWithAddress" async defer></script>';
$this->end();
?>
<?= $this->Breadcrumbs->render(
	['class' => 'breadcrumbs'],
	['separator' => '>']
)
?>

<div class="column-responsive column-80">
	<div class="flex content">
		<h3 class="heading_line"><?= h($clinic->name) ?></h3>
		<div class="post_wrapper">
			<p class="reviews"><i class="reviews_icon"></i><span>口コミ<b><?= count($clinic->reviews) ?></b>件</span></p>
			<!-- <div class="giza">
				<span class="giza_a"><!?= $this->Html->link(
								__('口コミ投稿'),
								[
									'controller' => 'Reviews',
									'action' => 'addFromClinic', $clinic->id
								],
								['class' => 'post']
							) ?>
				</span>
			</div> -->
		</div>
		<div class="Stars" style="--rating: <?= $clinic->rating ?>;" aria-label="Rating of this product.">
			<?= $clinic->rating ?>
		</div>
		<?php if (empty($clinic->image)) {
			echo $this->Html->image("upload/no-image.jpg", ['alt' => 'clinic image', 'class' => 'clinic_img']);
		} else {
			echo $this->Html->image("upload/${image}", ['alt' => 'clinic image', 'class' => 'clinic_img']);
		} ?>
		<p class="station">
			<svg class="station_icon" width="50" height="50">
				<use xlink:href="/mental_clinic/img/icon_station.svg#station"></use>
			</svg>
			<span class="guid">最寄り駅</span>　<?= h($clinic->station) ?>　<?= h($clinic->time) ?>
		</p>
		<p class="address">
			<!-- <!?= $this->Html->image('icon_address.svg', ['alt' => 'icon of address']) ?> -->
			<svg class="address_icon" width="50" height="50">
				<use xlink:href="/mental_clinic/img/icon_address.svg#icon_address"></use>
			</svg>
			<span class="guid">住所</span>　<?= h($clinic->address) ?>
		</p>
		<p class="phone_number">
			<!-- <!?= $this->Html->image('icon_phoneNumber.svg', ['alt' => 'icon of phone number']) ?> -->
			<svg class="phone_icon" viewBox="0 0 25 25" width="50" height="50">
				<use xlink:href="/mental_clinic/img/icon_phoneNumber.svg#icon_phone"></use>
			</svg>

			<span class="guid">電話番号</span>　
			<?php if (empty($clinic->phone_number)) : ?>
				なし
			<?php else : ?>
				<?= h($clinic->phone_number) ?>
			<?php endif; ?>
		</p>
		<div id="my_map" style="width: 100%; height: 60rem;"></div>

		<?= $this->Html->link(
			__('口コミ投稿'),
			[
				'controller' => 'Reviews',
				'action' => 'addFromClinic', $clinic->id
			],
			['class' => 'post, label']
		) ?>

		<div class="related">
			<h4 class="heading_line"><?= h($clinic->name) ?>の<?= __('口コミ') ?></h4>
			<?php if (!empty($clinic->reviews)) : ?>
				<div class="table-responsive">
					<?php foreach ($clinic->reviews as $reviews) : ?>
						<article class="article_grid">
							<p class="username">
								<?= $this->Html->link(
									$query[$reviews->user_id],
									['controller' => 'Users', 'action' => 'view', $reviews->user_id],
									['class' => 'label']
								) ?>さんの口コミ
								<span><?= h($reviews->created->format('Y年m月d日 H時i分')) ?></span>
							</p>
							<?php $content = $reviews->text; ?>
							<?= $this->Html->link(
								mb_strimwidth($content, 0, 50, '…（続きを読む）', 'UTF-8'),
								['controller' => 'Reviews', 'action' => 'view', $reviews->id]
							) ?>

						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
	var _my_address = "<?= $clinic->address ?>";

	function initMapWithAddress() {
		const opts = {
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		};
		const my_google_map = new google.maps.Map(document.getElementById('my_map'), opts);
		const geocoder = new google.maps.Geocoder();
		geocoder.geocode({
				'address': _my_address,
				'region': 'jp'
			},
			function(result, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					const latlng = result[0].geometry.location;
					my_google_map.setCenter(latlng);
					const marker = new google.maps.Marker({
						position: latlng,
						map: my_google_map,
						title: latlng.toString(),
						draggable: true
					});
					google.maps.event.addListener(marker, 'dragend', function(event) {
						marker.setTitle(event.latLng.toString());
					});

				}
			}
		);
	}
</script>