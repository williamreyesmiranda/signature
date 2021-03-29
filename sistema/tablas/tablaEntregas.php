<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Empresa</th>
            <th>Recibió</th>
            <th>Entregó</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
            
        </tr>
    </thead>
    <tfoot>
        <tr class="text-center">
        <th>ID</th>
            <th>Empresa</th>
            <th>Recibió</th>
            <th>Entregó</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
        </tr>
        </tr>
    </tfoot>
    <tbody>

        <?php include("../../db/Conexion.php");
        $conexion = new Conexion();
        $consultaSQL = "SELECT * FROM entregas ent 
                        INNER JOIN empresas empr ON empr.id_empresa=ent.empresa
                        INNER JOIN empleados empl ON empl.id_empleado=ent.empleado
                        INNER JOIN usuario us ON us.id_usuario=ent.usuario
                        ";
        $entregas = $conexion->consultarDatos($consultaSQL);
        foreach ($entregas as $entrega) :
            $datos = $entrega['id_entrega'] ;


        ?>
            <tr class="text-center">
                <td><?php echo ($entrega['id_entrega']); ?></td>
                <td><?php echo ($entrega['nombre_empresa']); ?></td>
                <td><?php echo ($entrega['nombre_empleado']); ?></td>
                <td><?php echo ($entrega['nombre_usuario']); ?></td>
                <td><?php echo ($entrega['fecha_ingreso']); ?></td>
                
                <td>
                    <h5>
                        <button class="btn btn-info" id=""onclick="cargarEntrega('<?php echo ($datos); ?>')"><i class="fas fa-check-circle"></i></button>
                        
                    </h5>
                </td>
            </tr>

        <?php

        endforeach;  ?>

    </tbody>
</table>
<!-- <script src="js/scri.js"></script> -->
<!-- datatable -->
<script>
    $(document).ready(function() {

        $('.tablaDinamica').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print',
                'csv'
            ],
            responsive: true,
            "order": [
                [0, "desc"]
            ],
            "pageLength": 10,
            "language": {
                "url": "../plugins/datatables/Spanish.json"
            },
        });
    });
</script>