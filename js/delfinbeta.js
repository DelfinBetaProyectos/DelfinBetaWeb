/*********************************************/
/*****                                   *****/
/*****  Documento CSS                    *****/
/*****                                   *****/
/*****  Fecha: 10/11/2016                *****/
/*****  Autor: Lcda. Dayan Betancourt    *****/
/*****                                   *****/
/*********************************************/

$(document).ready(function() {
	//----------------------------------------------------
	//  Encabezado
	//----------------------------------------------------
	$(window).on('scroll', function() {
		if($(window).scrollTop() > 80) {
			$('.encabezado-inicio').addClass('encabezado-fondo');
		} else {
			$('.encabezado-inicio').removeClass('encabezado-fondo');
		}
	});
	//----------------------------------------------------


	//----------------------------------------------------
	//  Suscripción
	//----------------------------------------------------
	$("#form_suscripcion").submit(function(ev) {
		ev.preventDefault();

		var enviar = true;
		var $campoNombre = $(this).find('input[name="nombre"]');
		var $campoEmail = $(this).find('input[name="email"]');

		var nombre = $campoNombre.val();
		var email = $campoEmail.val();

		$(".form-group").removeClass('has-error');
		$(".help-block").html("");
		$("#suscripcion_exito").addClass('hidden');
		$("#suscripcion_error").addClass('hidden');

		if(nombre == '') {
			$campoNombre.parents('.form-group').addClass('has-error');
			$("#bloqueErrorNombre").html("El Nombre es requerido");
			enviar = false;
		}

		if(email == '') {
			$campoEmail.parents('.form-group').addClass('has-error');
			$("#bloqueErrorEmail").html("El Email es requerido");
			enviar = false;
		}

		if(enviar) {
			$.post("ajax/suscripcion.php", { nombre: nombre, email: email }, function(data) {
				console.log("Error: " + data.error);
				console.log("Mensaje: " + data.mensaje);

				if(data.error) {
					$("#suscripcion_error").removeClass('hidden');
					$("#msjError").html(data.mensaje);
				} else {
					$("#suscripcion_exito").removeClass('hidden');
					$("#form_suscripcion").addClass('hidden');
				}
			}, "json");
		}
	});
	//----------------------------------------------------


	//----------------------------------------------------
	//  Suscripción
	//----------------------------------------------------
	$("#form_contacto").submit(function(ev) {
		ev.preventDefault();

		var enviar = true;
		var $campoNombre = $(this).find('input[name="nombre"]');
		var $campoEmail = $(this).find('input[name="email"]');
		var $campoMensaje = $(this).find('textarea[name="mensaje"]');

		var nombre = $campoNombre.val();
		var email = $campoEmail.val();
		var mensaje = $campoMensaje.val();

		$(".form-group").removeClass('has-error');
		$(".help-block").html("");
		$("#contacto_exito").addClass('hidden');
		$("#contacto_error").addClass('hidden');

		if(nombre == '') {
			$campoNombre.parents('.form-group').addClass('has-error');
			$("#bloqueErrorNombre").html("El Nombre es requerido");
			enviar = false;
		}

		if(email == '') {
			$campoEmail.parents('.form-group').addClass('has-error');
			$("#bloqueErrorEmail").html("El Email es requerido");
			enviar = false;
		}

		if(mensaje == '') {
			$campoMensaje.parents('.form-group').addClass('has-error');
			$("#bloqueErrorMensaje").html("El Mensaje es requerido");
			enviar = false;
		}

		if(enviar) { console.log("paso validacion");
			$.post("ajax/contacto.php", $(this).serialize(), function(data) {
				console.log("Error: " + data.error);
				console.log("Mensaje: " + data.mensaje);

				if(data.error) {
					$("#contacto_error").removeClass('hidden');
					$("#msjError").html(data.mensaje);
				} else {
					$("#contacto_exito").removeClass('hidden');
					document.getElementById("form_contacto").reset();
				}
			}, "json");
		}
	});
	//----------------------------------------------------
});