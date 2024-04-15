<?php
    session_start();
    if (!isset($_SESSION["administrador"])) {
        header("Location: ingresarAdmin.php"); // Redirigir al inicio de sesión si la sesión no está iniciada
        exit();
    }
?>

<?php
//atualizacion del usuario
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $comentario = $calificacion = "";
$nombre_err = $comentario_err = $calificacion_err = "";
$regiones = array(); // Nuevo campo para regiones
$regiones_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate NOMBRE
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un nombre.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor ingrese un nombre válido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate address address
    $input_comentario = trim($_POST["comentario"]);
    if(empty($input_comentario)){
        $comentario_err = "Por favor ingrese una dirección.";     
    } else{
        $comentario = $input_comentario;
    }
    
    // Validate salary
    $input_calificacion = trim($_POST["calificacion"]);
    if(empty($input_calificacion)){
        $calificacion_err = "Por favor ingrese calificacion.";     
    } elseif(!ctype_digit($input_calificacion)){
        $calificacion_err = "Por favor ingrese un valor positivo y válido.";
    } else{
        $calificacion = $input_calificacion;
    }

    // Validar REGIONES
    if(empty($_POST['region'])) {
        $regiones_err = "Por favor seleccione al menos una región.";
    } else {
        $regiones = $_POST['region'];
    }
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($comentario_err) && empty($calificacion_err)){
        // Prepare an update statement
        $sql = "UPDATE comentario SET nombre=?, region=?, comentario=?, calificacion=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssii", $param_nombre, $param_region, $param_comentario, $param_calificacion, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_comentario = $comentario;
            $param_calificacion = $calificacion;
            $param_id = $id;
            $param_region = implode(",", $regiones); // Convertir array a cadena separada por comas
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: indexAdmin.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM comentario WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["nombre"];
                    $comentario = $row["comentario"];
                    $calificacion = $row["calificacion"];
                    // Obtener regiones seleccionadas
                    $regiones = explode(",", $row["region"]);
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="cssPHPa.css" type="text/css" media="all">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body{
            background-color: rgba(109, 82, 42, 0.555);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Actualizar Registro</h2>
                    </div>
                    <p>Edite los valores de entrada y envíe para actualizar el registro.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($comentario_err)) ? 'has-error' : ''; ?>">
                            <label>Comentario</label>
                            <textarea name="comentario" class="form-control"><?php echo $comentario; ?></textarea>
                            <span class="help-block"><?php echo $comentario_err;?></span>
                        </div>
                        <div class="class-form">
                            <select name="region[]" multiple class="form-control">
                                <option value="America">America</option>
                                <option value="Asia">Asia</option>
                                <option value="Africa">Africa</option>
                                <option value="Europa">Europa</option>
                                <option value="Oceania">Oceania</option>
                            </select>
                        </div>
                        <div class="form-group <?php echo (!empty($calificacion_err)) ? 'has-error' : ''; ?>">
                            <label>Sueldo</label>
                            <input type="text" name="calificacion" class="form-control" value="<?php echo $calificacion; ?>">
                            <span class="help-block"><?php echo $calificacion_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar" id="b-g">
                        <a href="indexAdmin.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>