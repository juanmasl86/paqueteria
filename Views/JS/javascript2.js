var fases = [];
var acumulaciones = [];
var sumaTiempo = 0;

$.ajax({
    url: './includes/requestFases.php',
    dataType: "json",
    type: 'post',
        success: function (response) {
               response.forEach(function () {
                   var contador = 0;
                    fases.push(response[contador]);
                    sumaTiempo += response[contador].duration;
                    acumulaciones.push(sumaTiempo);
                   contador++; 
               });
            
        }

});

console.log(sumaTiempo);

//reloj en barra nav//
function mueveReloj(){
   var momentoActual = new Date()
    var hora = momentoActual.getHours()
    var minuto = momentoActual.getMinutes()
    var segundo = momentoActual.getSeconds()

    var horaImprimible = hora + " : " + minuto + " : " + segundo;

    $('#hora').text(horaImprimible);

    setTimeout(mueveReloj,1000)
}

// función localizador aleatorio //

function randomStr(logitud, alphanumeric) {
    var result = '';
    for (var i = logitud; i > 0; i--) {
        result +=
            alphanumeric[Math.floor(Math.random() * alphanumeric.length)];
    }
    return result;
}

function mostrarTiempo(id, timeSt) {
    if (timeSt < sumaTiempo) {
        
        for(var i = 0; i< acumulaciones.length-1; i++) {
                if(timeSt == (acumulaciones[i].duration+1)) {
                    $("#linea"+fases[i].id).text(fases[i+1].fases);
                }
            }


       var min = parseInt(timeSt / 60);
       var sec = parseInt(timeSt % 60);
       var mostrar = min+":"+sec;
        $("#"+id).text(mostrar);
        timeSt = timeSt+1;

        setTimeout(function(){
            mostrarTiempo(id, timeSt);
        }, 1000);

    } else {
        $("#"+id).text('');
        $("#linea"+id).text('');
        $("#final"+id).text('x');

    }

}

// datos registro //
function procesoRegistro() {
    var longitud = 4;
    var alphanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var locator = randomStr(longitud, alphanumeric);

    var parametros = {
        "locator": locator
    };

    $.ajax({
        data: parametros,
        url: './includes/addPackage.php',
        type: 'post',
        beforeSend: function () {
            $("#mensaje").html("Procesando, espere por favor");
        },
        success: function (response) {
            $("#mensaje").html(response);
        }

    });
}

function visualizar() {
    $.ajax({
        url: './includes/requestStatusPackage.php',
        type: 'post',

        success: function (response) {
            $("#mensaje").html(response);
        }
    });
}


    $(document).ready(function () {

        $("#botton1").click(function () {
            procesoRegistro();
        });

        $("#botton2").click(function () {
            visualizar();
        });

    });


