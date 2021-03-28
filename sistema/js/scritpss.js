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
                }else{
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

function registrarEntrega(){
    console.log($('#formIngresoEntrega').serialize(),);
}



