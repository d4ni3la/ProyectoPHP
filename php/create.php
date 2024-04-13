
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $comentario = $calificacion = "";
$nombre_err = $comentario_err = $calificacion_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese el nombre o usuario.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor ingrese un nombre válido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate COMENTARIO
    $input_comentario = trim($_POST["comentario"]);
    if(empty($input_comentario)){
        $comentario_err = "Por favor ingrese una dirección.";     
    } else{
        $comentario = $input_comentario;
    }
    
    // Validate CALIFICACION
    $input_calificacion = trim($_POST["calificacion"]);
    if(empty($input_calificacion)){
        $calificacion_err = "Por favor ingrese el monto del salario del empleado.";     
    } elseif(!ctype_digit($input_calificacion)){
        $calificacion_err = "Por favor ingrese un valor correcto y positivo.";
    } else{
        $calificacion = $input_calificacion;
    }
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($comentario_err) && empty($calificacion_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO comentario (nombre, comentario, calificacion) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_comentario, $param_calificacion);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_comentario = $comentario;
            $param_calificacion = $calificacion;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <h2>Agregar Nuevo Comentario</h2>
                    </div>
                    <p>Favor de agregar comentarios repetuosos</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($comentario_err)) ? 'has-error' : ''; ?>">
                            <label>Comentario</label>
                            <input type="text" name="comentario" class="form-control" value="<?php echo $comentario; ?>">
                            <span class="help-block"><?php echo $comentario_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($calificacion_err)) ? 'has-error' : ''; ?>">
                            <label>Calificacion</label>
                            <input type="text" name="calificacion" class="form-control" value="<?php echo $calificacion; ?>">
                            <span class="help-block"><?php echo $calificacion_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="indexAdmin.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>