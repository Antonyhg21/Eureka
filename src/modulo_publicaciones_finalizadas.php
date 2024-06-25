<?php
// *************************************************************************************************************************
// ** Éste archivo se encargará de mostrar al usuario aquellas publicaciones que ha finalizado y/o ya no estará buscando. **
// *************************************************************************************************************************

// Incluir el archivo de conexión a la base de datos
include "base_de_datos.php";

// Preparar la consulta SQL para obtener las publicaciones finalizadas del usuario
$s_publicaciones = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_rol_usuario,  a.estado_usuario, a.id_usuario, b.nom_usuario, 
a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
WHERE a.id_usuario  = ? AND
a.estado_usuario = false AND
a.id_usuario    = b.id_usuario AND
a.id_tipo       = c.id_tipo     AND
a.id_elemento   = d.id_elemento AND
d.id_tipo       = c.id_tipo     AND
a.id_depto      = e.id_depto    AND
a.id_munic      = f.id_munic    AND
f.id_depto      = e.id_depto    AND
a.id_sitio      = g.id_sitio    order by 20 desc LIMIT 20;');

// Ejecutar la consulta con el ID del usuario actual
$s_publicaciones->execute([$_SESSION['usuario']]);

// Obtener todas las publicaciones finalizadas en un array asociativo
$enc_publicaciones = $s_publicaciones->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-9">
    <h2>Búsquedas finalizadas</h2>
    <hr>
        <?php 
        // Verificar si el array de publicaciones está vacío
        if(empty($enc_publicaciones)): ?>
            <p>Aún no has finalizado ninguna búsqueda.</p>
        <?php else: 
            // Iterar sobre el array de publicaciones para mostrar cada una
            foreach ($enc_publicaciones as $publicacion): ?>
                <div class="card mb-3">
                    <div class="card-body" style="position: relative;">
                        <!-- Mostrar el estado de la búsqueda (activo/inactivo) -->
                        <div class="form-check form-switch form-check-reverse">
                            <label class="form-check-label" for="flexSwitchCheckReverse">Buscando</label>
                            <input disabled class="form-check-input flexSwitchCheckReverse" type="checkbox" data-id="<?php echo $publicacion['id_seekfind']; ?>" <?php echo $publicacion['estado_usuario'] ? 'checked' : ''; ?>>
                        </div>
                        <!-- Mostrar detalles de la publicación -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Nombre:</th>
                                    <td><?php echo $publicacion['nom_tipo'], "-", $publicacion['nom_elemento']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción:</th>
                                    <td><?php echo $publicacion['desc_elemento']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Departamento:</th>
                                    <td><?php echo $publicacion['nom_depto']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Municipio:</th>
                                    <td><?php echo $publicacion['nom_munic']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sitio:</th>
                                    <td><?php echo $publicacion['nom_sitio']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción del sitio:</th>
                                    <td><?php echo $publicacion['desc_sitio']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha:</th>
                                    <td><?php echo $publicacion['fecha']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Hora:</th>
                                    <td><?php echo $publicacion['hora']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; 
        endif; ?>
</div>