<?php
// Obtener el ID del departamento desde la solicitud GET
$tipo_elementoId = isset($_GET['tipo_elemento_id']) ? $_GET['tipo_elemento_id'] : null;
if ($tipo_elementoId !== null) {
    // Realizar la conexión a la base de datos (asegúrate de incluir tus credenciales y configuración)
    include 'base_de_datos.php'; // 'base_de_datos.php' archivo que contiene la conexión a la base de datos.

    // Consulta para obtener los elementos del tipo de elementos seleccionados
    $consulta = $base_de_datos->prepare('SELECT  a.id_elemento, a.nom_elemento FROM tab_elemento AS a, tab_tipo_elemento AS b 
                                        WHERE   a.id_tipo       = b. id_tipo  AND 
                                                a.id_tipo       = ?           ORDER BY 2');
    $consulta->execute([$tipo_elementoId]);
    $elementos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las ciudades como un JSON
    header('Content-Type: application/json');
    echo json_encode($elementos);
} else {
    // Manejar el caso en el que no se proporciona el ID del departamento
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: Se requiere el ID del tipo de elemento.';
}
?>