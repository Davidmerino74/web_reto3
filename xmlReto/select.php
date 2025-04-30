<?php
    $conn = mysqli_connect("localhost", "root", "", "biblioteca_muskiz");

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Hacemos la consulta a la base de datos
    $query = "SELECT * FROM libros";
    $result = mysqli_query($conn, $query);

    // Creamos el objeto XML
    $xml = new SimpleXMLElement('<libros></libros>');

    while($row = mysqli_fetch_assoc($result)) {
        $libro = $xml->addChild('libro');
        $libro->addChild('titulo', htmlspecialchars($row['titulo']));
        $libro->addChild('isbn', htmlspecialchars($row['isbn']));
    }

    // Cerramos la conexión
    mysqli_close($conn);

    // Preparar las cabeceras para forzar la descarga
    Header('Content-type: text/xml');
    Header('Content-Disposition: attachment; filename="libros.xml"');

    // Mostramos el contenido del XML generado
    echo $xml->asXML();
?>
