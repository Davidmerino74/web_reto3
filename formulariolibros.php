<?php 

include 'conexion.php';

//tabla libros
$titulo=$_REQUEST['titulo'];
$isbn=$_REQUEST['isbn'];

//tabla autores
$nombre=$_REQUEST['nombre'];
$apellidos=$_REQUEST['apellidos'];

//tabla libro_autor coge cod_libro y id_autor

//tabla ejemplares coge cod_libro e isbn y ademas
$id_ejemplar=$_REQUEST['id_ejemplar'];

$estado=$_REQUEST['estado'];
$disponibilidad=$_REQUEST['disponibilidad'];


//$querylibros="INSERT INTO libros (titulo,isbn) VALUES ('$titulo','$isbn')";

//$queryautores="INSERT INTO autores (nombre,apellidos) VALUES ('$nombre','$apellidos')";
//$querylibroautor="INSERT INTO libro_autor (cod_libro,id_autor) VALUES ('$cod_libro','$id_autor')";
//$queryejemplares="INSERT INTO ejemplares (id_ejemplar,cod_libro,isbn,estado,disponibilidad) VALUES ('$id_ejemplar','$cod_libro','$isbn','$estado','$disponibilidad')";

// verificar primary key cod_libro que no se repita
$verfiCod_libro=mysqli_query($conexion,"SELECT * FROM LIBROS WHERE titulo='$titulo' and isbn='$isbn'");

if (mysqli_num_rows($verfiCod_libro)>0){
    echo '
        <script>
        alert("Este libro ya esta registrado, intentalo de nuevo");

        window.location="formulariolibros.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();// con el exit nos salimos y no se ejecuta lo de abajo
}
// verificar primary key id_autor que no se repita
$verfiIdautor=mysqli_query($conexion,"SELECT * FROM AUTORES WHERE nombre='$nombre' and apellidos='$apellidos'");

if (mysqli_num_rows($verfiIdautor)>0){
    echo '
        <script>
        alert("Este Autor ya esta registrado, intentalo de nuevo");
        window.location="formulariolibros.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();// con el exit nos salimos y no se ejecuta lo de abajo
}
// verificar primary key id_ejemplar que no se repita
$verfiIdejemplar=mysqli_query($conexion,"SELECT * FROM EJEMPLARES WHERE ID_EJEMPLAR='$id_ejemplar'");

if (mysqli_num_rows($verfiIdejemplar)>0){
    echo '
        <script>
        alert("El código de este ejemplar ya esta registrado, intentalo de nuevo");
        window.location="formulariolibros.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();// con el exit nos salimos y no se ejecuta lo de abajo
}

    // Inserts guardados en variables "Query"
    $query="INSERT INTO libros (titulo,isbn) VALUES ('$titulo','$isbn')";
    $query2 = "INSERT INTO autores (nombre,apellidos) VALUES ('$nombre','$apellidos')";

    //Conexion a la base de datos y ejecución de los inserts 
    $ejecutar = mysqli_query($conexion, $query);
    $ejecutar = mysqli_query($conexion, $query2);

    // Variables para conseguir los id de libros y autores
    $datos_libros = "SELECT cod_libro FROM libros WHERE isbn = '$isbn'";
    $datos_autores = "SELECT id_autor FROM autores WHERE nombre = '$nombre' AND apellidos = '$apellidos'";

    echo $datos_libros;

    //Conexion a la base de datos y ejecucion de los selects
    $execute1 = mysqli_query($conexion, $datos_libros);
    $execute2 = mysqli_query($conexion, $datos_autores); ////////DONDE ESTÁN DATOS AUTORES

    //Si funciona el execute1 y hay un registro o mas dentro del execute1...
    if ($execute1 && mysqli_num_rows($execute1) > 0) {
        $datos_libros_db = mysqli_fetch_assoc($execute1); //...se guardan los datos en esta variable...
        $cod_libros = $datos_libros_db['cod_libro']; //...y se obtiene el id_libro a partir de esta
    }
    //lo mismo con los autores 
    if ($execute2 && mysqli_num_rows($execute2) > 0) {
        $datos_autores_db = mysqli_fetch_assoc($execute2);
        $id_autores = $datos_autores_db['id_autor'];
    }

    //echo "INSERT INTO libro_autor (cod_libro, id_autor) VALUES ($cod_libros, $id_autores)";
    //echo "INSERT INTO ejemplares (id_ejemplar, cod_libro, isbn, estado, disponibilidad) VALUES ($id_ejemplar, $cod_libros, $isbn, '$estado', '$disponibilidad')";
    
    //ahora que tenemos los id de libros y autores se inserta con un query en libauto
    $query3 = "INSERT INTO libro_autor (cod_libro, id_autor) VALUES ($cod_libros, $id_autores)";

    //Conexion a la base de datos y ejecucion de los insert
    $ejecutar = mysqli_query($conexion, $query3);

    $query4 = "INSERT INTO ejemplares (id_ejemplar, cod_libro, isbn, estado, disponibilidad) VALUES ($id_ejemplar, $cod_libros, $isbn, '$estado', '$disponibilidad')";
    $ejecutar = mysqli_query($conexion, $query4);

    echo '
            <script> 
                 alert("DATOS INTRODUCIDOS.");

                window.location = "formulariolibros.html";
            </script>
        ';


/////////////////////////////////////

mysqli_close($conexion);

?>