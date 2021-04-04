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
  <title>INICIO</title>

  <?php include "includes/scriptsUp.php" ?>
</head>

<style>
  #signatureparent {
    color: black;
    background-color: darkgrey;
    max-width: 350px;
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
              <h1 class="m-0">Reporte General de Entregas!!</h1>
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
          <?php
          if ($_SESSION['firma'] == "" && $_SESSION['idrol'] != 1) :
          ?>
            <form id="formIngresoEntrega">
              <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['iduser'] ?>">
              <div class="text-center mx-auto mb-5">
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

          <?php endif ?>

          <!-- Boxing de  reportes-->
          <div class="row">
            <!-- card total entregas -->
            <div class="col-12 col-sm-6 col-md-3">

              <div class="info-box">
                <?php
                $consultaSQL = "SELECT count(id_entrega) FROM entregas WHERE estado_entrega<=2";
                $result = $conexion->consultarDatos($consultaSQL);

                ?>
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clipboard-list"></i></i></span>
                <a class="text-white" data-toggle="collapse" href="#totalEntregas" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <div class="info-box-content ">
                    <?php
                    $consultaSQL = "SELECT count(id_entrega)  as 'contar' FROM entregas WHERE estado_entrega<=2";
                    $result = $conexion->consultarDatos($consultaSQL);

                    ?>
                    <span class="info-box-number">Total Entregas: <?php echo $result[0]['contar']; ?></span>
                    <span class="info-box-text">
                      Ver Detalle <i class="fas fa-angle-right"></i>
                    </span>
                  </div>
                </a>

              </div>

            </div>
            <!-- card total pendientes -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-question-circle"></i></span>
                <a class="text-white" data-toggle="collapse" href="#totalPendientes" role="button" aria-expanded="false" aria-controls="totalPendiente">
                  <div class="info-box-content ">
                    <?php
                    $consultaSQL = "SELECT count(id_entrega)  as 'contar' FROM entregas WHERE estado_entrega=1";
                    $result = $conexion->consultarDatos($consultaSQL);

                    ?>
                    <span class="info-box-number">Entregas Pendientes: <?php echo $result[0]['contar']; ?></span>
                    <span class="info-box-text">
                      Ver Detalle <i class="fas fa-angle-right"></i>
                    </span>
                  </div>
                </a>

              </div>

            </div>



            <div class="clearfix hidden-md-up"></div>
            <!-- card total aprobados -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

                <a class="text-white" data-toggle="collapse" href="#totalAprobadas" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <div class="info-box-content ">
                    <?php
                    $consultaSQL = "SELECT count(id_entrega)  as 'contar' FROM entregas WHERE estado_entrega=2";
                    $result = $conexion->consultarDatos($consultaSQL);

                    ?>
                    <span class="info-box-number">Entregas Aprobadas: <?php echo $result[0]['contar']; ?></span>
                    <span class="info-box-text">
                      Ver Detalle <i class="fas fa-angle-right"></i>
                    </span>
                  </div>
                </a>

              </div>

            </div>
            <!-- graficos -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-pie"></i></span>
                <a class="text-white" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <div class="info-box-content ">

                    <span class="info-box-number">Graficos</span>
                    <span class="info-box-text">
                      Ver Detalle <i class="fas fa-angle-right"></i>
                    </span>
                  </div>
                </a>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

          </div>


          <!-- acordeon de total entregas -->
          <div class="collapse" id="totalEntregas">
            <div class="card">
              <div class="card-header text-center font-weight-bold p-0">
                <h1>Total de Entregas</h1>
              </div>
              <div class="card-body">
                <table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Empresa</th>
                      <th>Recibió</th>
                      <th>Entregó</th>
                      <th>Fecha Registro</th>
                      <th>Estado Firma</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $consultaSQL = "SELECT * FROM entregas ent 
                        INNER JOIN empresas empr ON empr.id_empresa=ent.empresa
                        INNER JOIN empleados empl ON empl.id_empleado=ent.empleado
                        INNER JOIN usuario us ON us.id_usuario=ent.usuario
                        INNER JOIN estado_entrega esen ON ent.estado_entrega=esen.id_estado WHERE ent.estado_entrega<=2 ORDER BY empr.nombre_empresa";
                    $entregas = $conexion->consultarDatos($consultaSQL);
                    foreach ($entregas as $entrega) :
                      $datos = $entrega['id_entrega'] . "||" . $entrega['estado_entrega'] . "||";


                    ?>
                      <tr class="text-center">
                        <td><?php echo ($entrega['id_entrega']); ?></td>
                        <td><?php echo ($entrega['nombre_empresa']); ?></td>
                        <td><?php echo ($entrega['nombre_empleado'] . " (" . $entrega['cargo_empleado'] . ")"); ?></td>
                        <td><?php echo ($entrega['nombre_usuario']); ?></td>
                        <td><?php echo ($entrega['fecha_ingreso']); ?></td>
                        <td><?php echo ($entrega['nombre_estado']); ?></td>

                      </tr>

                    <?php

                    endforeach;  ?>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <!-- acordeon de entregas pendientes -->
          <div class="collapse" id="totalPendientes">
            <div class="card">
              <div class="card-header text-center font-weight-bold p-0">
                <h1>Entregas Pendientes por Aprobación</h1>
              </div>
              <div class="card-body">
                <table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Empresa</th>
                      <th>Recibió</th>
                      <th>Entregó</th>
                      <th>Fecha Registro</th>
                      <th>Estado Firma</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $consultaSQL = "SELECT * FROM entregas ent 
                        INNER JOIN empresas empr ON empr.id_empresa=ent.empresa
                        INNER JOIN empleados empl ON empl.id_empleado=ent.empleado
                        INNER JOIN usuario us ON us.id_usuario=ent.usuario
                        INNER JOIN estado_entrega esen ON ent.estado_entrega=esen.id_estado WHERE ent.estado_entrega=1 ORDER BY empr.nombre_empresa";
                    $entregas = $conexion->consultarDatos($consultaSQL);
                    foreach ($entregas as $entrega) :
                      $datos = $entrega['id_entrega'] . "||" . $entrega['estado_entrega'] . "||";


                    ?>
                      <tr class="text-center">
                        <td><?php echo ($entrega['id_entrega']); ?></td>
                        <td><?php echo ($entrega['nombre_empresa']); ?></td>
                        <td><?php echo ($entrega['nombre_empleado'] . " (" . $entrega['cargo_empleado'] . ")"); ?></td>
                        <td><?php echo ($entrega['nombre_usuario']); ?></td>
                        <td><?php echo ($entrega['fecha_ingreso']); ?></td>
                        <td><?php echo ($entrega['nombre_estado']); ?></td>

                      </tr>

                    <?php

                    endforeach;  ?>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
           <!-- acordeon de entregas pendientes -->
           <div class="collapse" id="totalAprobadas">
            <div class="card">
              <div class="card-header text-center font-weight-bold p-0">
                <h1>Entregas Aprobadas</h1>
              </div>
              <div class="card-body">
                <table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Empresa</th>
                      <th>Recibió</th>
                      <th>Entregó</th>
                      <th>Fecha Registro</th>
                      <th>Estado Firma</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $consultaSQL = "SELECT * FROM entregas ent 
                        INNER JOIN empresas empr ON empr.id_empresa=ent.empresa
                        INNER JOIN empleados empl ON empl.id_empleado=ent.empleado
                        INNER JOIN usuario us ON us.id_usuario=ent.usuario
                        INNER JOIN estado_entrega esen ON ent.estado_entrega=esen.id_estado WHERE ent.estado_entrega=2 ORDER BY empr.nombre_empresa";
                    $entregas = $conexion->consultarDatos($consultaSQL);
                    foreach ($entregas as $entrega) :
                      $datos = $entrega['id_entrega'] . "||" . $entrega['estado_entrega'] . "||";


                    ?>
                      <tr class="text-center">
                        <td><?php echo ($entrega['id_entrega']); ?></td>
                        <td><?php echo ($entrega['nombre_empresa']); ?></td>
                        <td><?php echo ($entrega['nombre_empleado'] . " (" . $entrega['cargo_empleado'] . ")"); ?></td>
                        <td><?php echo ($entrega['nombre_usuario']); ?></td>
                        <td><?php echo ($entrega['fecha_ingreso']); ?></td>
                        <td><?php echo ($entrega['nombre_estado']); ?></td>

                      </tr>

                    <?php

                    endforeach;  ?>

                  </tbody>
                </table>
              </div>
            </div>

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

</body>
<script>
  comparativo = '<?php echo $_SESSION['firma'] ?>';
  rol = '<?php echo $_SESSION['idrol'] ?>'
  if (comparativo == '' && rol != 1) {
    Swal.fire({
      position: 'center',
      icon: 'info',
      html: '<img src="../img/expertosip-logo.svg">',
      title: '<br>Registra tu Firma',

    })
  }
</script>
<script>
  $(function() {
    let signatureContainer = $('#firma').jSignature();

    $("#clear").click(function() {
      signatureContainer.jSignature("reset");
    });
    $(document).on('submit', '#formIngresoEntrega', function(e) {
      e.preventDefault();
      let formData = new FormData(this);

      formData.append("signature", signatureContainer.jSignature("getData", "svg"));

      $.ajax({
        url: "php/actualizarFirmaUsuario.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            html: '<img src="../img/expertosip-logo.svg">',
            title: '<br>Tu Firma Se ha Registrado',

            showConfirmButton: false,
            timer: 2000,
          }).then((result) => {
            window.location = "";
          })
        }
      });

    });



  });
</script>

</html>