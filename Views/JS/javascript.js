/**
 * Created by juanmartin.sanchez on 24/09/2019.
 */
// Ajax para calcular valor de la suma //
function procesoRegistro(){

    $.ajax({
        url: './Views/registro.php',
        type: 'post',
        beforeSend: function () {
            $("#formulario").html("Procesando, espere por favor")
        },
        success: function (response) {
            $("#formulario").html(response);
        }
    });
}

$( document ).ready(function() {

    $("#registrarse").click(function () {
        event.preventDefault();
        procesoRegistro();
    });

    $("#enter").click(function () {

        var parametros = {
            "username": $('#usuario').val(),
            "password": $('#password').val()
        };

        $.ajax({
            data: parametros,
            url: './index.php',
            type: 'post',
           /* beforeSend: function () {
                $("#error").html("Procesando, espere por favor");
            },
            success: function (response) {
                $("#error").html(response);
            }*/
        });
    });

});
