<?php
     if (isset($_POST['inicio'])) {
        header("Location: login.php");
        exit(); // Asegura que el script detenga la ejecución después de la redirección
    } else{
        header("Location: empleado.html");
    }
?>