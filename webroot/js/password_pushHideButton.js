function password_pushHideButton() {
	const txtPass = document.querySelector("#password");
	const btnEye = document.querySelector("#password_buttonEye");
	if (txtPass.type === "text") {
		txtPass.type = "password";
		btnEye.className = "fa fa-eye";
	} else {
		txtPass.type = "text";
		btnEye.className = "fa fa-eye-slash";
	}
}

function password_confirm_pushHideButton() {
	const txtPass = document.querySelector("#password-confirm");
	const btnEye = document.querySelector("#password-confirm_buttonEye");
	if (txtPass.type === "text") {
		txtPass.type = "password";
		btnEye.className = "fa fa-eye";
	} else {
		txtPass.type = "text";
		btnEye.className = "fa fa-eye-slash";
	}
}