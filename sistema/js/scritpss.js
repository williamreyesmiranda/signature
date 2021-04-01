$(document).ready(function () {

    $('.select2').select2({
        theme: 'bootstrap4'
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

function registrarEntrega() {
    let empresa = $.trim($('#empresa').val());
    let empleado = $.trim($('#empleado').val());
    let cantidad = $.trim($('#cantidad').val());
    let descripcion = $.trim($('#descripcion').val());

    if (empresa.length == "" || empleado.length == "" || cantidad.length == "" || descripcion.length == "") {
        Swal.fire({
            position: 'center',
            icon: 'info',
            html: '<img src="../img/expertosip-logo.svg">',
            title: '<br>Hay campos obligatorios vacíos',
            background: ' #000000cd',
            showConfirmButton: false,
            timer: 2000,

        });
    }

}

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

function formEditarusuario(datos) {
    d = datos.split('||');
    $(".idUsuario").val(d[0]);
    $(".nombre").val(d[1]);
    $(".cargo").val(d[2]);
    $(".area").val(d[3]);
    $(".usuario").val(d[4]);
    $(".clave").val(d[5]);
    $(".correo").val(d[6]);
    $('#modalEditarUsuario').modal('show');
}

function registrarUsuario() {
    $.ajax({
        type: "POST",
        url: "php/registrarUsuario.php",
        data: $('#registrarUsuario').serialize(),
        dataType: "json",
        success: function (d) {
            if (d == 1) {
                $('#modalRegistrarUsuario').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Usuario Ingresado Correctamente',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Error al Intentar Ingresar Usuario',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        }
    });
}

function editarUsuario() {
    $.ajax({
        type: "POST",
        url: "php/editarUsuario.php",
        data: $('#editarUsuario').serialize(),
        dataType: "json",
        success: function (d) {
            if (d == 1) {
                $('#modalEditarUsuario').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Usuario Editado Correctamente',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/expertosip-logo.svg">',
                    title: '<br>Error al Intentar Editar Usuario',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        }
    });
}

