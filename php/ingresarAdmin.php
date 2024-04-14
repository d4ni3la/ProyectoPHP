<?php
    if ($_POST) {
        session_start();
        if ($_POST["administrador"]== "adminDaniela" && $_POST["contra"]== "02admin") {
            $_SESSION["administrador"]= $_POST["administrador"];
            echo "Sesion Iniciada";
            header("Location: indexAdmin.php");
        }
        else
            header("Location: index.php");
    }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="cssPHP.css" type="text/css" media="all">
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
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">    
        <form action="" method="post">
            <div class="container-fluid">
                
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Iniciar Sesión Administrador</h2>
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="">Usuario</label>
                        <input type="text" name="administrador" id="" >
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="" >Contraseña</label>
                        <input type="password" name="contra" id="">
                    </div>
                    <div class="form-group">
                        <br>
                        <input type="submit" value="Ingresar" class="btn btn-primary"  id="b-g">
                    </div>
                    <!--
                    <div class="form-group">
                        <br><br><br>
                        <a href="indexAdmin.php">Regresar a comentarios</a>
                    </div>-->
                    <a href="index.php" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>