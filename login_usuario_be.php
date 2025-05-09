<?php

    include 'conexion.php';


    $correo = $_POST['correo'];
    $contrasena = $_POST['password'];
    
    //$contrasena = hash('sha512', $contrasena);

    $validar_login = mysqli_query($conexion, "SELECT * FROM personas WHERE email='$correo' and contrasena='$contrasena'");
 
    
    if (mysqli_num_rows($validar_login) > 0 ){
        
        header("location: Index.html");
        exit();
 
    }else{
        echo '
            <script> 
                 alert("Usuario no existe, por favor verifique los datos introducidos.");

                window.location = "login.php";
            </script>
        ';

        exit();
    }

    
?>