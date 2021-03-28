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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INICIO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap.css">
  <!-- SweetAlert -->
  <link href="../plugins/sweetalert2/sweetalert2.css" rel="stylesheet">
</head>
<style>

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
              <h1 class="m-0">Entrega Conformidad</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Inicio</li>

              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- contenido-header -->

      <section class="content">
        <!-- inicio cuerpo de trabajo -->
        <div class="container-fluid">

          <div class=" mx-auto d-block border border-dark rounded col-md-9 mb-4">
            <h2 class="mx-auto d-block mt-2 p-1 text-center">Registro de Entregas de Satisfacción</h2>
            <form action="" id="formIngresoEntrega" class="needs-validation mt-4 p-2 " method="POST" novalidate>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <?php
                  $consultaProcesos = "SELECT * FROM empresas WHERE activo=1";
                  $empresas = $conexion->consultarDatos($consultaProcesos);
                  ?>
                  <label for="empresa">Empresa (*):</label>
                  <select class="form-control select2" name="empresa" id="empresa" required>
                    <option value="" selected disabled>Seleccione Una Empresa</option>
                    <?php foreach ($empresas as $empresa) : ?>
                      <option value="<?php echo ($empresa['id_empresa']) ?>"><?php echo ($empresa['nombre_empresa']) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Ingrese La empresa</div>
                </div>
                <div class="form-group col-md-6">
                  <label>Nit: </label>
                  <input type="text" id="nit" class="form-control" disabled>
                </div>

                <div class="form-group col-md-6">

                  <label for="empleado">Empleado (*):</label>
                  <select class="form-control select2" name="empleado" id="empleado" required>
                  </select>
                  <div class="invalid-feedback">Ingrese El empleado</div>
                </div>
                <div class="form-group col-md-6">
                  <label>Cargo : </label>
                  <input type="text" id="cargo" class="form-control" disabled>
                </div>
                <div class="col-sm-12 text-center">
                  <div class="form-group text-center">
                    <a type="button" title="Agregar Filas" class="mr-2 font-weight-bold" onclick="agregarFila()"><i class="fas fa-plus-circle text-white"></i></a>
                    <a type="button" title="Eliminar Filas" class="font-weight-bold" onclick="eliminarFila()"><i class="fas fa-minus-circle text-white"></i></a>
                  </div>
                  
                    <table class="table table-striped table-dark rounded" id="tablaeditarprueba">
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
                          <td><input type="number" name="cantidad[]" class="form-control" value="" required></td>
                          <td><input type="text" name="descripcion[]" class="form-control" required></td>
                          <td><input type="number" name="marca[]" class="form-control"></td>
                          <td><input type="number" name="serial[]" class="form-control"></td>
                        </tr>

                      </tbody>
                    </table>
                 
                </div>
                <!-- /.card-header -->
            <div class="form-group col-md-12">
            <label for="obs">Observaciones:</label>
              <textarea id="obs" name="obs" class="form-control"></textarea>
            </div>


                <button type="submit" class="btn btn-dark mb-5 mt-3 d-block mx-auto" name="botonRegistro" id="botonRegistro" onclick="registrarEntrega()">Registrar Entrega</button>
            </form>
          </div>


        </div>
        <!-- fin cuerpo de trabajo -->
      </section>
    </div>
    <!-- fin contenido-wrapper -->


    <!-- Main Footer -->
    <?php include "includes/footer.php" ?>

  </div>
  <!-- fin wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="../plugins/raphael/raphael.min.js"></script>
  <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <script src="../plugins/sweetalert2/sweetalert2.js"></script>
  <script src="js/scritpss.js"></script>

  <script>
  $(function () {
    // Summernote
    $('#obs').summernote({
      placeholder: 'Digite su Observación',
    }); })
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
                        <td><input type="number" name="marca[]" class="form-control"></td>
                        <td><input type="number" name="serial[]" class="form-control"></td>
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
</body>

</html>