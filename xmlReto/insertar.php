<?php
   $conn = mysqli_connect("localhost","root","","biblioteca_muskiz");

   if (file_exists('libros.xml')) {

    $xml =simplexml_load_file("./libros.xml") or die ("Error: No se puedo crear el objeto.");

    foreach($xml->children () as $libros){
        $titulo = $libros->titulo;
        $isbn = $libros ->isbn;

        $sql = "INSERT INTO libros (titulo, isbn) VALUES ('$titulo', '$isbn')";

        $result =mysqli_query($conn, $sql);

        if (! empty($result)){
        }else {
            $error_message = mysqli_error($conn) . "\n";
        }
        
    }
    mysqli_close($conn);
}else{
    echo "No se ha encontrado el documento";
}

?>
<h2>Información insertada en la tabla BIBLIOTECA DE MUSKIZ</h2>
<?php
?>
