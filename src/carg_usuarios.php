<?php
require "base_de_datos.php";

$buscar = isset($_POST['buscar']) ? $_POST['buscar'] : null;

if ($buscar !== null) {
    $sentencia = $base_de_datos->prepare('SELECT a.id_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, a.dir_usuario, b.nom_depto, c.nom_munic 
    FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c WHERE (a.id_depto = b.id_depto) AND (a.id_munic = c.id_munic) AND (a.id_usuario LIKE ?) ORDER BY 1 LIMIT 10');
    $sentencia->execute(["$buscar%"]);
    $d_usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
    $d_usuarios = [];
}

$html = '';

if ($d_usuarios) {
    foreach ($d_usuarios as $list_usuarios) {
        $html .= '<tr>
            <td>' . $list_usuarios->id_usuario . '</td>
            <td>' . $list_usuarios->doc_usuario . '</td>
            <td>' . $list_usuarios->nom_usuario . '</td>
            <td>' . $list_usuarios->ape_usuario . '</td>
            <td>' . $list_usuarios->cel_usuario . '</td>
            <td>' . $list_usuarios->dir_usuario . '</td>
            <td>' . $list_usuarios->nom_depto . '</td>
            <td>' . $list_usuarios->nom_munic . '</td>
            <td><a class="btn btn-warning btn-sm" href="edit_usuarios.php?id_usuario=' . $list_usuarios->id_usuario . '">Editar</a> </td>
            <td><a href="#" class="btn btn-danger btn-sm">Eliminar</a> </td>
        </tr>';
    }
} else {
    $html .= '<tr>
        <td colspan="10" class="text-center">No hay datos para mostrar</td>
    </tr>';
}

echo json_encode($html);
?>
