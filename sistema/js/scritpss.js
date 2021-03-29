$(document).ready(function () {

    $('.select2').select2({
        theme: 'bootstrap4'
    });

    let signatureContainer = $('#firma').signature();
    signatureContainer.signature({
        color: '#000'
    });


});


// Validar formularios
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$("#empresa").change(function () {
    $.ajax({
        type: "POST",
        url: "php/cargarNit.php",
        data: $('#formIngresoEntrega').serialize(),
        dataType: "json",
        success: function (data) {
            $("#nit").val(data);
        }
    });
    $.ajax({
        type: "POST",
        url: "php/cargarEmpleados.php",
        data: $('#formIngresoEntrega').serialize(),
        success: function (data) {
            $("#empleado").html(data);

        }
    });

});

$("#empleado").change(function () {
    $.ajax({
        type: "POST",
        url: "php/cargarCargo.php",
        data: $('#formIngresoEntrega').serialize(),
        dataType: "json",
        success: function (data) {
            $("#cargo").val(data);
        }
    });
});

/* function registrarEntrega(){
    let empresa = $.trim($('#empresa').val());
    let empleado = $.trim($('#empleado').val());
    let cantidad = $.trim($('#cantidad').val());
    let descripcion = $.trim($('#descripcion').val());
    
    if (empresa.length == "" || empleado.length == ""|| cantidad.length == "" || descripcion.length == "") {
        Swal.fire({
            position: 'center',
            icon:'info',
            html: '<img src="../img/expertosip-logo.svg">',
            title: '<br>Hay campos obligatorios vacíos',
            background: ' #000000cd',
            showConfirmButton: false,
            timer: 2000,
  
          });
    }else{
        $.ajax({
           type: "POST",
           url: "php/ingresarEntrega.php",
           data: $('#formIngresoEntrega').serialize(),
           dataType: "json",
           success: function (data) {
               console.log(data);
              if(data==1){
                Swal.fire({
                    position: 'center',
                    icon:'success',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Entrega de Satisfacción Registrada Corectamente',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
          }).then((result) => {
            window.location = "";
        });
              }else{
                Swal.fire({
                    position: 'center',
                    icon:'danger',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Error al Registrar Entrega',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
          
                  });
              }
           }
       });
    }
    
} */

function cargarEntrega(d) {

    let idEntrega = "idEntrega=" + d;
    $.ajax({
        type: "POST",
        url: "php/cargarEntrega.php",
        data: idEntrega,
        success: function (data) {
            $(".mostrarEntrega").html(data);
        }
    });



}

