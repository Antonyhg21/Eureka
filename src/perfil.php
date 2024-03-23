<?php
include_once 'encabezado.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Mi perfil</title>
</head>
<?php
include "base_de_datos.php";
$s_info_usuario = $base_de_datos->prepare("SELECT a.id_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, 
        a.dir_usuario, b.nom_depto, c.nom_munic 
        FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c 
        WHERE id_usuario = ? AND
            a.id_depto = b.id_depto AND
            a.id_munic = c.id_munic AND
            b.id_depto = c.id_depto;");
$s_info_usuario->execute([$_SESSION['usuario']]);
$enc_info_usuario = $s_info_usuario->fetch(PDO::FETCH_ASSOC);



$s_publicaciones = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_rol_usuario,  a.estado_usuario, a.id_usuario, b.nom_usuario, 
a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
WHERE a.id_usuario  = ?  AND
a.id_usuario    = b.id_usuario AND
a.id_tipo       = c.id_tipo     AND
a.id_elemento   = d.id_elemento AND
d.id_tipo       = c.id_tipo     AND
a.id_depto      = e.id_depto    AND
a.id_munic      = f.id_munic    AND
f.id_depto      = e.id_depto    AND
a.id_sitio      = g.id_sitio    order by 20 desc LIMIT 20;');
$s_publicaciones->execute([$_SESSION['usuario']]);
$enc_publicaciones = $s_publicaciones->fetchAll(PDO::FETCH_ASSOC);

?>
<body class="body">
    <br><br>
<div class="container bg-light mt-5 mb-5 p-3 rounded shadow">
    <div class="row">
    <div class="col-md-4">
            <h2>Información del usuario</h2>
            <p>E-mail: <?php echo $enc_info_usuario['id_usuario']; ?></p>
            <p>Documento: <?php echo $enc_info_usuario['doc_usuario']; ?></p>
            <p>Nombres: <?php echo $enc_info_usuario['nom_usuario']; ?></p>
            <p>Apellidos: <?php echo $enc_info_usuario['ape_usuario']; ?></p>
            <p>Celular: <?php echo $enc_info_usuario['cel_usuario']; ?></p>
            <p>Dirección: <?php echo $enc_info_usuario['dir_usuario']; ?></p>
            <p>Departamento: <?php echo $enc_info_usuario['nom_depto']; ?></p>
            <p>Municipo: <?php echo $enc_info_usuario['nom_munic']; ?></p>
            <!-- Aquí puedes agregar más información del usuario -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarUsuarioModal">
                Editar perfil
            </button>
            <!-- Modal para editar usuario -->
            <div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarUsuarioModalLabel">Editar perfil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="editar_perfil.php" method="post">
                                <!-- Aquí puedes agregar los campos del formulario para editar el perfil del usuario -->
                                <input type="hidden" name="id" value="<?php echo $enc_info_usuario['id_usuario']; ?>">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $enc_info_usuario['id_usuario']; ?>">
                                </div>
                                <!-- Agrega más campos según sea necesario -->
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2>Mis publicaciones</h2>
            <?php foreach ($enc_publicaciones as $publicacion): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: <?php echo $publicacion['nom_tipo'], "-", $publicacion['nom_elemento'] ; ?></h5>
                        <p class="card-text">Descripción: <?php echo $publicacion['desc_elemento']; ?></p>
                        <p class="card-text">Departamento: <?php echo $publicacion['nom_depto']; ?></p>
                        <p class="card-text">Municipio: <?php echo $publicacion['nom_munic']; ?></p>
                        <p class="card-text">Sitio: <?php echo $publicacion['nom_sitio']; ?></p>
                        <p class="card-text">Descripción del sitio: <?php echo $publicacion['desc_sitio']; ?></p>
                        <p class="card-text">Fecha: <?php echo $publicacion['fecha']; ?></p>
                        <p class="card-text">Hora: <?php echo $publicacion['hora']; ?></p>
                        <button type="button" class="btn btn-primary editarPublicacion" data-id="<?php echo $publicacion['id_seekfind']; ?>" data-nombre="<?php echo $publicacion['nom_tipo']; ?>">
                            Editar
                        </button>
                        <a href="eliminar_publicacion.php?id=<?php echo $publicacion['id_seekfind']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Modal para editar publicación -->
<div class="modal fade" id="editarPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="editarPublicacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPublicacionModalLabel">Editar publicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="editar_publicacion.php" method="post">
                    <input type="hidden" id="publicacionId" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="publicacionNombre" name="nombre">
                    </div>
                    <!-- ... -->
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editarPublicacionButtons = document.querySelectorAll('.editarPublicacion');
        editarPublicacionButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var nombre = this.getAttribute('data-nombre');
                document.getElementById('publicacionId').value = id;
                document.getElementById('publicacionNombre').value = nombre;
                var modal = new bootstrap.Modal(document.getElementById('editarPublicacionModal'));
                modal.show();
            });
        });

        // Aquí está el nuevo código para manejar el evento de clic del botón de edición de usuario
        var editarUsuarioButton = document.querySelector('[data-target="#editarUsuarioModal"]');
        editarUsuarioButton.addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('editarUsuarioModal'));
            modal.show();
        });
    });
</script>
<!-- ... -->
</body>
</html>