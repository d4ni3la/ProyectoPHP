<?php
    session_start();
    session_destroy();      //destruye la sesion
    header("Location: index.php");
    echo "Sesion Cerrada";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for=""><a href="index.php">INICIO</a></label>
</body>
</html>