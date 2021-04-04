<?php
session_start();
include "../db/Conexion.php";
$conexion = new Conexion();

if (empty($_SESSION['active'])) {
    header('location: ../');
}
$usuario = $_SESSION['iduser'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRO DE ENTREGA</title>

    <?php include "includes/scriptsUp.php" ?>
</head>

<style>
    #signatureparent {
        color: black;
        background-color: darkgrey;
        max-width: 380px;
        padding: 10px;
        border-radius: 6px;
    }

    #firma {
        border: 2px dotted black;
        background-color: lightgrey;
    }

    html.touch #content {
        float: left;
        width: 92%;
    }
</style>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include "includes/navbar.php" ?>

        <!-- Contentido Wrapper-->
        <div class="content-wrapper">
            <!-- contenido-header -->
            <div class="content-header">
                <div class="container-fluid">

                    <!-- inicio de cuerpo de trabajo -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Formulario</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Registro Entrega</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contenido-header -->

            <section class="content">
                <!-- inicio cuerpo de trabajo -->
                <div class="container-fluid">

                    <div class=" mx-auto d-block border border-dark rounded col-md-12 mb-4">
                        <h2 class="mx-auto d-block mt-2 p-1 text-center">Registro de Entregas de Satisfacción</h2>
                        <form action="" id="formIngresoEntrega" class="needs-validation mt-4 p-2 " method="POST" novalidate>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <?php
                                    $consultaProcesos = "SELECT * FROM empresas WHERE estado_empresa=1 ORDER BY nombre_empresa";
                                    $empresas = $conexion->consultarDatos($consultaProcesos);
                                    ?>
                                    <label for="empresa">Empresa (*):</label>
                                    <select class="form-control select2" name="empresa" id="empresa" required>
                                        <option value="" selected disabled>Seleccione Una Empresa</option>
                                        <?php foreach ($empresas as $empresa) : ?>
                                            <option value="<?php echo ($empresa['id_empresa']) ?>"><?php echo ($empresa['nombre_empresa']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">Ingrese la empresa</div>
                                </div>
                                <div class="form-group col-md-6" style="color:darkgray">
                                    <label>Nit: (Automático)</label>
                                    <input type="text" id="nit" class="form-control" style="color:darkgray" disabled>
                                </div>
                                <div class="form-group col-md-5 col-11">
                                    <label for="empleado">Recibe (*):</label>
                                    <select class="form-control select2" name="empleado" id="empleado" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese el nombre de la persona</div>
                                </div>
                                <div class="form-group col-1 text-center my-auto">
                                    <a title="Agregar Empleado"><i class="fas fa-user-plus text-white" data-toggle="modal" data-target="#modalRegistrarEmpleado"></i></a>
                                </div>
                                <div class="form-group col-md-6" style="color:darkgray">
                                    <label>Cargo : (Automático)</label>
                                    <input type="text" id="cargo" class="form-control" style="color:darkgray" disabled>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <div class="form-group text-center">
                                        <a type="button" title="Agregar Filas" class="mr-2 font-weight-bold" onclick="agregarFila()"><i class="fas fa-plus-circle text-white"></i></a>
                                        <a type="button" title="Eliminar Filas" class="font-weight-bold" onclick="eliminarFila()"><i class="fas fa-minus-circle text-white"></i></a>
                                    </div>
                                    <table class="table table-striped table-dark rounded table-sm" id="tablaeditarprueba" width="1000px" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="80px">N°</th>
                                                <th scope="col" width="100px">Cant (*)</th>
                                                <th scope="col">Descripción (*)</th>
                                                <th scope="col" width="25%">Marca</th>
                                                <th scope="col" width="20%">Serial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td><input type="number" id="cantidad" name="cantidad[]" class="form-control" required></td>
                                                <td><input type="text" id="descripcion" name="descripcion[]" class="form-control" required></td>
                                                <td><input type="text" name="marca[]" class="form-control"></td>
                                                <td><input type="text" name="serial[]" class="form-control"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-header -->
                                <div class="form-group col-md-12">
                                    <label for="obs">Observaciones:</label>
                                    <textarea id="obs" name="obs" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="text-center mx-auto">
                                <center>

                                    <button type="button" class="btn btn-info mb-3" id="clear">Limpiar Firma</button>
                                    <div id="content" class="">
                                        <div id="signatureparent">
                                            <div id="firma"></div>
                                        </div>
                                    </div>
                                </center>
                                <div class="justify-content-center">
                                    <div class="text-center">

                                        <button type="submit" class="btn btn-dark mt-3" name="botonRegistro" id="botonRegistro">Registrar Entrega</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- fin cuerpo de trabajo -->
            </section>
        </div>
        <!-- fin contenido-wrapper -->
        <!-- Main Footer -->
        <?php /* include "includes/footer.php"  */ ?>

    </div>
    <!-- fin wrapper -->
    <?php include "includes/scriptsDown.php" ?>
    <script>
        $(document).ready(function() {

        });
    </script>
    <script>
        $(function() {
            // Summernote
            $('#obs').summernote({
                placeholder: 'Digite su Observación',
            });
        })
    </script>
    <script>
        function agregarFila() {
            var table = document.getElementById("tablaeditarprueba");
            var rowCount = table.rows.length;
            if (rowCount > 10) {
                Swal.fire({
                    position: 'center',
                    html: '<br><img src="../img/expertosip-logo.svg">',
                    title: '<br>No se puede ingresar más de 10 filas',
                    background: ' #000000cd',
                    showConfirmButton: false,

                });
            } else {
                document.getElementById("tablaeditarprueba").insertRow(-1).innerHTML = `<tr>
                        <td scope="row">` + rowCount + `</td>
                        <td ><input type="number" name="cantidad[]" class="form-control" required></td>
                        <td><input type="text" name="descripcion[]" class="form-control" required></td>
                        <td><input type="text" name="marca[]" class="form-control"></td>
                        <td><input type="text" name="serial[]" class="form-control"></td>
                      </tr>`;
            }

        }

        function eliminarFila() {
            var table = document.getElementById("tablaeditarprueba");
            var rowCount = table.rows.length;

            if (rowCount <= 2) {
                Swal.fire({
                    position: 'center',
                    html: '<br><img src="../img/expertosip-logo.svg">',
                    title: '<br>No se puede eliminar la primer fila',
                    background: ' #000000cd',
                    showConfirmButton: false,
                    timer: 2000,

                });
            } else {
                table.deleteRow(rowCount - 1);
            }
        }
    </script>

    <script>
        $(function() {
            let signatureContainer = $('#firma').jSignature();

            $("#clear").click(function() {
                signatureContainer.jSignature("reset");
            });
            $(document).on('submit', '#formIngresoEntrega', function() {

                let formData = new FormData(this);

                formData.append("signature", signatureContainer.jSignature("getData", "svg"));

                $.ajax({
                    url: "php/ingresarEntrega.php",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data == 1) {
                            /* envio correo */
                            $.ajax({
                                type: "POST",
                                url: "php/correoEntrega.php",
                                success: function(data) {
                                    }
                            });

                            /* mensaje de registro completado */
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                html: '<img src="../img/expertosip-logo.svg">',
                                title: '<br>Entrega de Satisfacción Registrada Corectamente',
                                background: ' #000000cd',
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {
                                window.location = "";
                            })
                        }

                    }
                });

            });



        });
    </script>
</body>

</html>