<?php
// Obtener el ID del municipio desde la solicitud GET
$municipioId = isset($_GET['munic_id']) ? $_GET['munic_id'] : null;
if ($municipioId !== null) {
    // Realizar la conexión a la base de datos (asegúrate de incluir tus credenciales y configuración)
    include 'base_de_datos.php'; // 'base_de_datos.php' archivo que contiene la conexión a la base de datos.

    // Consulta para obtener las ciudades del municipio seleccionado
    $consulta = $base_de_datos->prepare('SELECT a.id_sitio, a.nom_sitio FROM tab_sitios AS a, tab_deptos AS b, tab_munics AS c 
                                        WHERE   a.id_depto = b.id_depto     AND
                                                b.id_depto = c.id_depto     AND
                                                a.id_munic = c.id_munic     AND
                                                a.id_munic = ?              ORDER BY 2');
    $consulta->execute([$municipioId]);
    $sitios = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las ciudades como un JSON
    header('Content-Type: application/json');
    echo json_encode($sitios);
} else {
    // Manejar el caso en el que no se proporciona el departamento ni el municipio
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: Se requiere selección de el departamento y el municipio.';
}
?>