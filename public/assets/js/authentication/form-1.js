$(document).ready(function () {
	var togglePassword = document.getElementById("toggle-password");

	if (togglePassword) {
		togglePassword.addEventListener('change', function () {
			document.querySelectorAll("[id^=password]").forEach(function (el) {
				if (el.type === "password") {
					el.type = "text";
				} else {
					el.type = "password";
				}
			});
		});
	}
	
	$("[data-form]").submit(function (e) {
		e.preventDefault();
		let action = $(this).data('form');
		let method = $(this).attr('method');
		let route_return = $(this).data("return");
		let data = $(this).serialize();
		let submit = $(this).find('[type=submit]');
		let currentText = submit.text();
		$.ajax({
			url: action,
			method: method,
			data: data,
			dataType: 'json',
			beforeSend: function () {
				submit.attr("disabled", true).text("Chờ...");
			},
			success: function (json) {
				if (json.errors) {
					$.each(json.errors, function (k, v) {
						if (v) $(`#${k}-field small`).html(v);
						else $(`#${k}-field small`).empty();
					});
				} else if (json.success) {
					$("[id*=-field] small").empty();
					Snackbar.show(json.alert);
					location.href = route(route_return);
				} else {
					$("[id*=-field] small").empty();
					Snackbar.show(json.alert);
				} 
				submit.attr("disabled", false).text(currentText);
			},
			error: function (err) {
				console.error(err);
				$("[id*=-field] small").empty();
				Snackbar.show({
					text: 'Xảy ra lỗi',
					actionTextColor: '#fff',
					backgroundColor: '#e7515a',
					actionText: 'Đóng'
				});
				submit.attr("disabled", false).text(currentText);
			}
		});
	});
});