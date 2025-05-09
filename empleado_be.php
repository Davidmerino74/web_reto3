<?php
    include 'conexion.php';


    $nSS = $_POST['seguridadsocial'];
    $contrasena = $_POST['password'];


    //$contrasena = hash('sha512', $contrasena);

    echo "SELECT * FROM personas WHERE n_segsocial='$nSS' and contrasena='$contrasena'";
 
    $validar_empe = mysqli_query($conexion, "SELECT * FROM personas WHERE n_segsocial='$nSS' and contrasena='$contrasena'");

    if (mysqli_num_rows($validar_empe) > 0 ){
        
        header("location: formulariolibros.html");
        exit();

    }else{
        echo '
        <script> 
             alert("NO ERES EMPLEADO. No es posible acceder a tu cuenta, por favor intentelo de nuevo.");

            window.location = "Index.html";
        </script>
    ';

    exit();
    }

?>