<?php
// Obtener el ID del departamento desde la solicitud GET
$departamentoId = isset($_GET['depto_id']) ? $_GET['depto_id'] : null;
if ($departamentoId !== null) {
    // Realizar la conexión a la base de datos (asegúrate de incluir tus credenciales y configuración)
    include 'base_de_datos.php'; // Reemplaza 'conexion.php' con el nombre de tu archivo de conexión

    // Consulta para obtener las ciudades del departamento seleccionado
    $consulta = $base_de_datos->prepare('SELECT  id_munic, nom_munic FROM tab_munics WHERE id_depto = ? ORDER BY 2');
    $consulta->execute([$departamentoId]);
    $municipios = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las ciudades como un JSON
    header('Content-Type: application/json');
    echo json_encode($municipios);
} else {
    // Manejar el caso en el que no se proporciona el ID del departamento
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: Se requiere el ID del departamento.';
}
?>