/*
	アバターをupload時、動的に画像を表示する
*/

function imgPreView(event) {
	const file = event.target.files[0];
	const reader = new FileReader();
	const previewImage = document.getElementById("previewImage");

	// if (previewImage != null) {
	// 	preview.removeChild(previewImage);
	// }
	reader.onload = (event) => {
		const img = document.querySelector(".avatar");
		img.setAttribute("src", reader.result);
		img.setAttribute("id", "previewImage");
	}

	reader.readAsDataURL(file);
}