$(function() {

    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
    	demoHeaderBox = $('#javascript-header-demo-box');
    	demoHeaderBox
    		.hide()
    		.text('Hello from JavaScript! This line has been added by public/js/application.js')
    		.css('color', 'green')
    		.fadeIn('slow');
    }

    // if #javascript-ajax-button exists
    if ($('#javascript-ajax-button').length !== 0) {

        $('#javascript-ajax-button').on('click', function(){
            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php
            $.ajax(url + "/songs/ajaxGetStats")
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    $('#javascript-ajax-result-box').html(result);
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

    // para ocultar automáticamente los mensajes de error
    setTimeout(function() {
        $('.error-feedback').hide(1000);
    }, 3000);

    $('.link-how-many').on('click', function (e) {
        e.preventDefault();
        const link = $(this); // el enlace
        let url = link.attr('href'); // obtenemos la ruta del enlace
        console.log(url);
        link .children().load(url); // cargamos el contenido de la url en el span
    });

    // vamos a mostrar el contenido de la vista answerInserted en la misma página del formulario formAnswer por AJAX
    // esto ocurrirá cuando se envie el formulario (evento submit)
    // se trata de en lugar de que el form envie los datos por post de la manera tradicional, los vamos a enviar nosotros por AJAX
    /*
    ES EQUIVALENTE A:
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success,
            dataType: dataType
        });
     */
    $('#formAnswer').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action'); // obtenemos la url del action
        // url es donde mandamos los datos, form.serialize son los datos, y luego viene la funcion que se ejecuta una vez se realiza todo
        $.post(url, form.serialize(), function (serverResponse) {
            $('.mensajef').html(serverResponse);
        })
    })
});
