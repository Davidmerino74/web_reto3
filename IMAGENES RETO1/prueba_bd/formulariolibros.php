<?php 

include 'conexion.php';
//tabla libros
$cod_libro=$_REQUEST['cod_libro'];
$titulo=$_REQUEST['titulo'];
$isbn=$_REQUEST['isbn'];

//tabla autores
$id_autor=$_REQUEST['id_autor'];
$nombre=$_REQUEST['nombre'];
$apellidos=$_REQUEST['apellidos'];

//tabla libro_autor coge cod_libro y id_autor

//tabla ejemplares coge cod_libro e isbn y ademas
$id_ejemplar=$_REQUEST['id_ejemplar'];

$estado=$_REQUEST['estado'];
$disponibilidad=$_REQUEST['disponibilidad'];



$querylibros="INSERT INTO libros (cod_libro,titulo,isbn) VALUES ('$cod_libro','$titulo','$isbn')";
$queryautores="INSERT INTO autores (id_autor,nombre,apellidos) VALUES ('$id_autor','$nombre','$apellidos')";
$querylibroautor="INSERT INTO libro_autor (cod_libro,id_autor) VALUES ('$cod_libro','$id_autor')";
$queryejemplares="INSERT INTO ejemplares (id_ejemplar,cod_libro,isbn,estado,disponibilidad) VALUES ('$id_ejemplar','$cod_libro','$isbn','$estado','$disponibilidad')";

// verificar primary key cod_libro que no se repita
$verfiCod_libro=mysqli_query($conexion,"SELECT * FROM LIBROS WHERE COD_LIBRO='$cod_libro'");

if (mysqli_num_rows($verfiCod_libro)>0){
    echo '
        <script>
        alert("Este código libro ya esta registrado, intentalo de nuevo");
        window.location="./formulariolibros.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();// con el exit nos salimos y no se ejecuta lo de abajo
}
// verificar primary key id_autor que no se repita
$verfiIdautor=mysqli_query($conexion,"SELECT * FROM AUTORES WHERE ID_AUTOR='$id_autor'");

if (mysqli_num_rows($verfiIdautor)>0){
    echo '
        <script>
        alert("Este código autor ya esta registrado, intentalo de nuevo");
        window.location="./formulariolibros.html";
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
        alert("Este Id_ejemplar ya esta registrado, intentalo de nuevo");
        window.location="./formulariolibros.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();// con el exit nos salimos y no se ejecuta lo de abajo
}



//ejecutar los 4 insert

$ejecutarlibros=mysqli_query($conexion,$querylibros);
$ejecutarautores=mysqli_query($conexion,$queryautores);
$ejecutarlibroautor=mysqli_query($conexion,$querylibroautor);
$ejecutarejemplares=mysqli_query($conexion,$queryejemplares);

if ($ejecutarlibros && $ejecutarautores && $ejecutarlibroautor && $ejecutarejemplares){
    echo '
    <script>
        alert("datos introducidos ok");
        window.location="./formulariolibros.html";
    </script>
    ';    
}else{
    echo '
    <script>
        alert("intentalo de nuevo, algún dato es incorrecto");
        window.location="./formulariolibros.html";
    </script>
    ';
}

mysqli_close($conexion);

?>