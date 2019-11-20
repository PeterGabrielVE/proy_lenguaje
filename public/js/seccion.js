$(document).ready(function(){
	var estado = false;
	var estado2 = false;
	var estado3 = false;
	var estado4 = false;
	var estado5 = false;


	var icon = document.getElementById('icon');
	var icon2 = document.getElementById('icon2');
	var icon3 = document.getElementById('icon3');
	var icon4 = document.getElementById('icon4');

	$('#btn-toogle1').on('click', function(){
		$('.seccionToogle').slideToggle();

		if(estado == true){
			 icon.classList.toggle('fa-plus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado = true;
		}else{
			 icon.classList.toggle('fa-minus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado = false;
		}
	});

	$('#btn-toogle2').on('click', function(){
		$('.seccionToogle2').slideToggle();

		if(estado2 == true){
			 icon2.classList.toggle('fa-plus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado2 = true;
		}else{
			 icon2.classList.toggle('fa-minus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado2 = false;
		}
	});

	$('#btn-toogle3').on('click', function(){
		$('.seccionToogle3').slideToggle();

		if(estado3 == true){
			 icon3.classList.toggle('fa-plus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado3 = true;
		}else{
			 icon3.classList.toggle('fa-minus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado3 = false;
		}
	});

	$('#btn-toogle4').on('click', function(){
		$('.seccionToogle4').slideToggle();

		if(estado4 == true){
			 icon4.classList.toggle('fa-plus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado4 = true;
		}else{
			 icon4.classList.toggle('fa-minus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado4 = false;
		}
	});

	$('#btn-toogle5').on('click', function(){
		$('.seccionToogle5').slideToggle();

		if(estado5 == true){
			 icon5.classList.toggle('fa-plus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado5 =true;
		}else{
			 icon5.classList.toggle('fa-minus-circle');
			 $('body').css({
			 	"overflow": "scroll"
			 });
			 estado5 = false;
		}
	});


});

