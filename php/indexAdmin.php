<?php
    session_start();
    if (!isset($_SESSION["administrador"])) {
        header("Location: ingresarAdmin.php"); // Redirigir al inicio de sesión si la sesión no está iniciada
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="cssPHPa.css" type="text/css" media="all">
    <link rel="stylesheet" href="../continentes/h-f.css" type="text/css" media="all">
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        body{
            background-color: rgba(109, 82, 42, 0.555);
        }
        .pie{
            background-color: rgba(109, 82, 42, 0.555);
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Sección de Comentarios</h2>
                        <a href="registroAcciones.php" class="btn btn-success pull-right" id="b-g">Registro de acciones</a>
                        <!--
                        <a href="createAdmin.php" class="btn btn-success pull-right" id="b-g">Agregar nuevo comentario</a>-->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM comentario";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Region</th>";
                                        echo "<th>Comentario</th>";
                                        echo "<th>Calificacion</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['region'] . "</td>";
                                        echo "<td>" . $row['comentario'] . "</td>";
                                        echo "<td>" . $row['calificacion'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='readAdmin.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>

                    <div>
                        <a href="cerrarAdmin.php" class="btn btn-success pull-right" id="b-g">Cerrar Sesion Administrador</a>
                        <br><br><br><br><br>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <div class="pie">       <!--div que contiene la imagen con vinculo hacia la pagina de inicio-->
        <div class="hom">
            <a href="../index.html"><img src="../imgs/home.png" class="tam-hom"></a>
            <br>
        </div> 
    </div>
</body>
</html>