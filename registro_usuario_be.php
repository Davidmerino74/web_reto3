<?php

    include 'conexion.php';

    $dni = $_POST ['dni'];
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST ['telefono'];
    $direccion = $_POST ['direccion'];
    $correo = $_POST['email'];
    $usuario = $_POST ['usuario'];
    $contrasena = $_POST ['contrasena'];
    $n_segsocial = $_POST ['n_segsocial'];

    //Encriptamiento
    //$contrasena = hash('sha512', $contrasena);
 
    $query = "INSERT INTO personas(dni, nombre_completo, telefono, direccion, email, nombre_usuario, contrasena, n_segsocial) 
                VALUES ('$dni', '$nombre_completo', '$telefono', '$direccion', '$correo', '$usuario', '$contrasena', '$n_segsocial')";


    //////////////////////////////////////////Verificar que no se repita en la base de datos

    $verificar_dni = mysqli_query($conexion, "SELECT * FROM personas WHERE dni='$dni'");


    if(mysqli_num_rows($verificar_dni) > 0 ){
        echo '
            <script>
                alert("Este usuario ya esta registrado (DNI REPETIDO)");
                window.location = "login.php";
            </script>
        ';
        exit();
    }

    $verificar_user = mysqli_query($conexion, "SELECT * FROM personas WHERE nombre_usuario='$usuario'");


    if(mysqli_num_rows($verificar_user) > 0 ){
        echo '
            <script>
                alert("Este usuario ya esta registrado (USUARIO REPETIDO)");
                window.location = "login.php";
            </script>
        ';
        exit();
    }

    $verificar_SS = mysqli_query($conexion, "SELECT * FROM personas WHERE n_segsocial='$n_segsocial'");


    if(mysqli_num_rows($verificar_SS) > 0 ){
        echo '
            <script>
                alert("Este usuario ya esta registrado (Nº SS REPETIDO)");
                window.location = "login.php";
            </script>
        ';
        exit();
    }

    ////////////////////////////////////////////////////////////////////////////

    $ejecutar = mysqli_query($conexion, $query);
    
    if($ejecutar){
        echo '
            <script>
                alert ("Usuario almacenado.");
                window.location = "login.php";
            </script>
        ';
    }else{
        echo'
         <script>
                alert ("No es posible almacenar este usuario.");
                window.location = "login.php";
            </script>
        ';
    }

    mysqli_close($conexion);

?>