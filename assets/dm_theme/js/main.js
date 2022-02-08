// JavaScript Document

$(document).ready(function () {
	//inizializzazioni al caricamento della pagina
	$(".hamburger").click(function () {
		toggleMenuSlider();
	})

	$(".pianeta").hover(function () {
		toggleBg();
	})

})

function toggleMenuSlider() {
	$(".hamburger").toggleClass("is-active");
	$('#menuBurger').toggleClass("closed");
}

function toggleBg() {
	$(".pianeta").toggleClass("anelli");
}

