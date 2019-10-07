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
        link.children().load(url); // cargamos el contenido de la url en el span
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
        });
    });

    $('.numAnswersSuccess').hide();

    $('#formAnswerJSON').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action'); // obtenemos la url del action
        const divMensaje = $('#mensajef');
        $.ajax(url, {
            data: form.serialize(), // mandamos el contenido del form en formato JSON
            method: 'post',
            dataType: 'json'
        }).done(function(res) { // cuando termine la solicitud ajax, lo que yo reciba como respuesta...
            console.log(res);
            // res -> es el JSON de la vista answerInsertedJSON
            if(res.success) {
                form.hide(1000); // que se oculte el formulario si hemos insertado una respuesta
                $('.salida').hide(1000); // ocultamos la lista de respuestas (solo se ve si pulsamos botón showSendAnswers)
                $('.numAnswers').hide(); // ocultamos el nº de respuestas que hay en la bbdd antes de insertar una nueva
                divMensaje.show().addClass('bg-success p-3');
                $('.numAnswersSuccess').show().html('<p>Número de respuestas: ' + res.number + '</p>') // mostramos el nº de respuestas una vez insertada una nueva
            }
            divMensaje.html(res.msg); // si insertamos -10 caracteres o no escribimos nada
        }).fail(function() {
            alert( "error" );
        })
    });

    $('#showSendAnswers').on('click', function(e) {
        e.preventDefault();
        const link = $(this); // el enlace
        let url = link.attr('href'); // obtenemos la ruta del enlace
        // obstenemos el JSON de la vista questions/getAnswersJSON.php
        $.getJSON(url, function(res) {
            const listDiv = document.getElementById('salida');
            const ul = document.createElement('ul');
            ul.classList.add('list-group');
            ul.classList.add('mt-3');
            listDiv.appendChild(ul);
            console.log(res.answers.length);
            for (let i = 0; i < res.answers.length; ++i) {
                let li = document.createElement('li');
                li.classList.add('list-group-item');
                li.innerHTML = res.answers[i].respuesta;   // Use innerHTML to set the text
                ul.appendChild(li);
            }
        });
    });

    $('#showSendAnswersHandlebars').on('click', function(e) {
        e.preventDefault();
        const link = $(this); // el enlace
        let url = link.attr('href'); // obtenemos la ruta del enlace
        $.getJSON(url, function(res) {
            const capa = $('#answerHandleBars1');
            console.log(res);
            /*for(let actual in res) {
                capa.html(capa.html() + res[actual].respuesta + '<br>');
            }*/
            const template = $('#template').html(); // obtenemos el html de la plantilla handlebars
            const tmpl = Handlebars.compile(template); // compilamos la plantilla
            let contexto = {};
            contexto.answers = res; // el contexto será el JSON que obtenemos al clickar al botón
            const responseHTML = tmpl(contexto); // asigamos a una variable la plantilla + contexto
            capa.html(responseHTML);
        })
    });

    $('#showSendAnswersHandlebars2').on('click', function(e) {
        e.preventDefault();
        const link = $(this); // el enlace
        let url = link.attr('href'); // obtenemos la ruta del enlace
        $.getJSON(url, function(res) {
            const capa2 = $('#answerHandleBars2');
            const template2 = $('#templateHandlebars').html();
            const tmpl2 = Handlebars.compile(template2);
            let contexto2 = {};
            contexto2.answers = res;
            const responseHTML2 = tmpl2(contexto2);
            capa2.html(responseHTML2);
        })
    })
});
