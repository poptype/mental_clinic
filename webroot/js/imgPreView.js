/*
	アバターをupload時、動的に画像を表示する
*/

function imgPreView(event) {
	console.log(document.querySelector(".avatar") != null);
	const file = event.target.files[0];
	const reader = new FileReader();
	const previewImage = document.getElementById("previewImage");

	// if (previewImage != null) {
	// 	preview.removeChild(previewImage);
	// }
	if (document.querySelector(".avatar") != null) {
		reader.onload = (event) => {
			const img = document.querySelector(".avatar");
			img.setAttribute("src", reader.result);
			img.setAttribute("id", "previewImage");
		}
	}
	if (document.querySelector(".clinic_img") != null) {
		reader.onload = (event) => {
			const img = document.querySelector(".clinic_img");
			img.setAttribute("src", reader.result);
			img.setAttribute("id", "previewImage");
		}
	}

	reader.readAsDataURL(file);
}