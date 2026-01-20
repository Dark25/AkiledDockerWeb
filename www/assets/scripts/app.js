function dropdown() {
	document.getElementById("user-space-dropdown").classList.toggle("show");
	document.getElementById("user-menu-trigger").classList.toggle("active");
}


window.onclick = function (event) {
	if (!event.target.closest('#user-menu-trigger') && !event.target.closest('#user-space-dropdown')) {
		var dropdowns = document.getElementsByClassName("page-content-user-space-right-side-item-dropdown-content");
		var triggers = document.getElementsByClassName("page-content-user-space-right-side-item-nav");

		for (var i = 0; i < dropdowns.length; i++) {
			if (dropdowns[i].classList.contains('show')) {
				dropdowns[i].classList.remove('show');
			}
		}
		for (var i = 0; i < triggers.length; i++) {
			if (triggers[i].classList.contains('active')) {
				triggers[i].classList.remove('active');
			}
		}
	}
}

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function () {
		this.classList.toggle("active");
		var payment = this.nextElementSibling;
		if (payment.style.display === "block") {
			payment.style.display = "none";
		}

		else {
			payment.style.display = "block";
		}
	});
}