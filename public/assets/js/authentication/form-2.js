var togglePassword = document.getElementById("toggle-password");
var togglePasswordConfirmed = document.getElementById("toggle-password-confirmed");
var formContent = document.getElementsByClassName('form-content')[0]; 
var getFormContentHeight = formContent.clientHeight;

var formImage = document.getElementsByClassName('form-image')[0];
if (formImage) {
	var setFormImageHeight = formImage.style.height = getFormContentHeight + 'px';
}
if (togglePassword) {
	togglePassword.addEventListener('click', function() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	});
}

if (togglePasswordConfirmed) {
	togglePasswordConfirmed.addEventListener('click', function () {
		var x = document.getElementById("password_confirmed");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	});
}

$(document).ready(function () {
	$("[data-form]").submit(function (e) {
		e.preventDefault();
		let action = $(this).data('form');
		let method = $(this).attr('method');
		let url_return = $(this).data("return");
		let data = $(this).serialize();
		$.ajax({
			url: action,
			method: method,
			data: data,
			dataType: 'json',
			success: function (res) {
				console.log(res);
			},
			error: function (res) {
				console.log(res);
			}
		});
	});
});