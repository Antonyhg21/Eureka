<?php
require "base_de_datos.php"; // Incluye el archivo 'base_de_datos.php' que contiene la conexión a la base de datos.

// Verifica si se ha enviado el parámetro 'buscar' mediante POST, si no, asigna null.
$buscar = isset($_POST['buscar']) ? $_POST['buscar'] : null;

if ($buscar !== null) {
    // Prepara la consulta SQL para buscar usuarios por email, incluyendo información de departamento y municipio.
    $sentencia = $base_de_datos->prepare('SELECT a.id_usuario, a.email_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, a.dir_usuario, b.nom_depto, c.nom_munic 
        FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c 
        WHERE   (a.id_depto     = b.id_depto)   AND 
                (a.id_munic     = c.id_munic)   AND 
                (a.email_usuario LIKE ?)ORDER BY 1 LIMIT 10');
    // Ejecuta la consulta con el parámetro 'buscar' añadiendo un comodín para coincidencias parciales.
    $sentencia->execute(["$buscar%"]);
    // Obtiene los resultados como un array de objetos.
    $d_usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
    // Si no se especificó 'buscar', inicializa el array de usuarios como vacío.
    $d_usuarios = [];
}

$html = ''; // Inicializa la variable para construir el HTML.

if ($d_usuarios) {
    // Itera sobre el array de usuarios para construir las filas de la tabla HTML.
    foreach ($d_usuarios as $list_usuarios) {
        $html .= '<tr>
            <td>' . $list_usuarios->id_usuario . '</td>
            <td>' . $list_usuarios->email_usuario . '</td>
            <td>' . $list_usuarios->doc_usuario . '</td>
            <td>' . $list_usuarios->nom_usuario . '</td>
            <td>' . $list_usuarios->ape_usuario . '</td>
            <td>' . $list_usuarios->cel_usuario . '</td>
            <td>' . $list_usuarios->dir_usuario . '</td>
            <td>' . $list_usuarios->nom_depto . '</td>
            <td>' . $list_usuarios->nom_munic . '</td>
            <td><a class="btn btn-warning btn-sm" href="edit_usuarios.php?id_usuario=' . $list_usuarios->id_usuario . '">Editar</a> </td>
            <td><a href="#" class="btn btn-danger btn-sm">Inhabilitar</a> </td>
        </tr>';
    }
} else {
    // Si no hay usuarios que mostrar, añade una fila indicándolo.
    $html .= '<tr>
        <td colspan="10" class="text-center">No hay datos para mostrar</td>
    </tr>';
}

echo json_encode($html); // Codifica el HTML construido a JSON y lo envía como respuesta.
?>