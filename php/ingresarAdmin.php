<?php
    if ($_POST) {
        session_start();
        if ($_POST["administrador"]== "adminDaniela" && $_POST["contra"]== "02admin") {
            $_SESSION["administrador"]= $_POST["administrador"];
            echo "Sesion Iniciada";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Usuario</label>
        <input type="text" name="administrador" id="">
        <label for="">Contraseña</label>
        <input type="password" name="contra" id="">
        <input type="submit" value="Enviar"><a href="indexAdmin.php">Inicio</a>
    </form>
</body>
</html>