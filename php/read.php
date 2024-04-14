<?php
// parametro ID exista
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM comentario WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["nombre"];
                $address = $row["comentario"];
                $salary = $row["calificacion"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../continentes/h-f.css" type="text/css" media="all">
    <link rel="stylesheet" href="cssPHP.css" type="text/css" media="all">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ver Comentario</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre / usuario</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Comentario</label>
                        <p class="form-control-static"><?php echo $row["comentario"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Calificacion</label>
                        <p class="form-control-static"><?php echo $row["calificacion"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary" id="b-g">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>