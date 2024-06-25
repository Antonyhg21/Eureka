<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está conectado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

include "base_de_datos.php";
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if ($input === null) {
    // Manejar el error de que no se recibieron datos JSON válidos
    echo json_encode(['error' => 'No se recibieron datos válidos.']);
    exit();
}

$id_seekfind = $input['id_seekfind'] ?? null; // Usar el operador de fusión de null para manejar valores no establecidos

// Asegúrate de validar y sanear $id_seekfind antes de usarlo en tu consulta para prevenir inyecciones SQL
$s_publicaciones = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_rol_usuario,  a.estado_usuario, a.id_usuario, b.nom_usuario, 
a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
WHERE a.id_seekfind = ? AND
a.id_usuario    = ?  AND
a.estado_usuario = true AND
a.id_usuario    = b.id_usuario AND
a.id_tipo       = c.id_tipo     AND
a.id_elemento   = d.id_elemento AND
d.id_tipo       = c.id_tipo     AND
a.id_depto      = e.id_depto    AND
a.id_munic      = f.id_munic    AND
f.id_depto      = e.id_depto    AND
a.id_sitio      = g.id_sitio    order by 20 desc LIMIT 20;');

// Combina los parámetros en un solo array
$params = [$id_seekfind, $_SESSION['usuario']];     // Ejecutar la consulta con los parámetros proporcionados.
$s_publicaciones->execute($params);     // Pasa el array combinado como un solo argumento
$publicacion = $s_publicaciones->fetch(PDO::FETCH_ASSOC);   // Obtener la publicación como un array asociativo.

echo json_encode($publicacion);     // Codificar la publicación como JSON y enviarla como respuesta.
?>