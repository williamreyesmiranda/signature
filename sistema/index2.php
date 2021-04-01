<?php
$con = mysqli_connect('localhost', 'root', '', 'signature') or die("ERROR");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Bootstrap 4 jQuery UI Signature - rhalp10</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- jQuery UI Signature core CSS -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="../assets/css/jquery.signature.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!--   <style>
            .kbw-signature {
                width: 400px;
                height: 100px;
            }
        </style> -->
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.4/examples/jumbotron/jumbotron.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Bootstrap 4 jQuery UI Signature</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <main role="main">

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-6">
                    <br><br><br><br><br><br><br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <h2>Signature Canvas</h2>

                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <h2>Submit with Name</h2>
                    <div class="border rounded p-0">
                    <div id="signatureContainer2"></div>
                    </div>
                    
                    <div style="clear: both;" class="btn btn-group">
                                        <button class="btn btn-outline-danger" id="clear">Borrar</button>
                                    </div>
                    <form id="signatureForm">
                        <div class="form-group">
                            <label for="inputSignatureName">Name</label>
                            <input type="text" class="form-control" id="inputSignatureName" name="signatureName" required="">
                        </div>
                        <button class="btn btn-outline-success" id="submit">SUBMIT</button>
                    </form>
                </div>
                <div id="firma"></div>
                <div class="col-md-6 table-responsive">
                    <h2>Signature Table</h2>
                    <table class="table table-bordered" id="signatureTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th width="25%">Signature</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                </div>

            <hr>

        </div>
        <!-- /container -->

    </main>

    <footer class="container">
        <p>Bootstrap 4 jQuery UI Signature &copy; 2020</p>
    </footer>

    <!--[if IE]>
<script src="excanvas.js"></script>
<![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../assets/js/jSignature.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {

            var signatureTable = $('#signatureTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "fetchTable.php",
                    type: "POST"

                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

            var signatureContainer = $('#signatureContainer2').jSignature({
                color: '#000'
            });

            $('#clear').click(function() {
                signatureContainer.jSignature('reset');
            });

          

            $(document).on('click', '#loadSignature', function() {
                var person_ID = $(this).attr("data-id");
                $.ajax({
                    url: "action.php",
                    method: 'POST',
                    data: {
                        action: "load",
                        "person_ID": person_ID
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#firma').html(data.firma);
                    }
                });

            });
            $(document).on('click', '#deleteSignature', function() {
                var person_ID = $(this).attr("data-id");
                $.ajax({
                    url: "action.php",
                    method: 'POST',
                    data: {
                        action: "delete",
                        "person_ID": person_ID
                    },
                    dataType: 'json',
                    success: function(data) {
                        alert(data.msg);
                        signatureTable.ajax.reload();
                    }
                });
            });


            $(document).on('submit', '#signatureForm', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
               
                formData.append("action", "submit");
                formData.append("signature", signatureContainer.jSignature("getData","svg"));
                $.ajax({
                    url: "action.php",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        alert(data.msg);
                        signatureTable.ajax.reload();
                    }
                });
            });

        });
    </script>

</body>

</html>