<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" type="text/css" href="estilos.css" media="all">
        <link rel="icon" href="IMAGENES RETO1/favicon.PNG">
    </head>
 
    <body> 
        <div class="login-container"> 
            <h1>Iniciar Sesión</h1>

            <form action="login_usuario_be.php" method="POST" class="login-form">
                
                <label for="username">Correo electrónico</label>
                <input type="text" id="username" name="correo" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Acceder</button>
                <p class="register-link">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
                <p class="register-link">¿Has olvidado tu contraseña? <a href="password.html">Recuperar aquí</a></p>
            </form>
        </div>
    </body>
</html>
