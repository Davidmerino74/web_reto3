<!DOCTYPE html> 
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" type="text/css" href="estilos.css" media="all">
        <link rel="icon" href="IMAGENES RETO1/favicon.PNG">
    </head>
 
    <body class="registromargen">
        
        <div class="login-container">
            <h1>Registro</h1>
            <form action="registro_usuario_be.php" method="POST" class="login-form">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="nombre_completo" required>

                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" required>

                <label for="telephone">Teléfono</label>
                <input type="text" id="telephone" name="telefono" required>

                <label for="direction">Dirección</label>
                <input type="text" id="direction" name="direccion" required>

                    <br>
                    <br>
                    <br>

                    <hr>

                    <br>
                    
                <label for="email">Correo electrónico</label>
                <input type="text" id="email" name="email" required>

                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="usuario" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="contrasena" required>

                <label for="confirm_password">Repetir contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <label for="confirm_password">NºSeguridad social</label>
                <input type="text" id="n_segsocial" name="n_segsocial" required>

                <br>
                    <br>

                    <hr>

                <button type="submit">Registrarse</button>
                <p class="register-link">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
            </form>
        </div>
    </body>
</html>