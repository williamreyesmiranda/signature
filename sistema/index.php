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
              <h1 class="m-0">Inicio</h1>
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
          if ($_SESSION['firma'] == "" && $_SESSION['idrol']!=1) :
          ?>
            <form id="formIngresoEntrega">
              <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['iduser'] ?>">
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

                    <button type="submit" class="btn btn-dark mt-3" name="botonRegistro" id="botonRegistro" >Registrar Entrega</button>
                  </div>
                </div>
              </div>

            </form>

          <?php endif ?>


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
  rol='<?php echo $_SESSION['idrol'] ?>'
  if (comparativo == ''&& rol!=1) {
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