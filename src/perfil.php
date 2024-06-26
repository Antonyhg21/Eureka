<?php
// Incluir el archivo de encabezado
include_once 'encabezado.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Ajustar la visualización a la anchura del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vincular hoja de estilos CSS -->
    <link rel="stylesheet" href="../css/styles.css">
    <title>Mi perfil</title>
</head>
<?php
// Incluir el archivo de conexión a la base de datos
include "base_de_datos.php";

// Preparar consulta SQL para obtener publicaciones del usuario
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
// Ejecutar consulta con el ID de usuario de la sesión actual
$s_publicaciones->execute([$_SESSION['usuario']]);
// Obtener todas las publicaciones como un array asociativo
$enc_publicaciones = $s_publicaciones->fetchAll(PDO::FETCH_ASSOC);

?>
<body class="body">
    <br><br>
<div class="container bg-light mt-5 mb-5 p-3 rounded shadow">
    <div class="row">
        <div class="col-md-8">
            <h2>Mis publicaciones</h2>
            <?php 
            // Verificar si el usuario no tiene publicaciones
            if(empty($enc_publicaciones)): ?>
                <p>No has hecho ninguna publicación aún.</p>
            <?php else: 
                // Iterar sobre cada publicación y mostrarla
                foreach ($enc_publicaciones as $publicacion): ?>
                    <div class="card mb-3">
                        <div class="card-body" style="position: relative;">
                            <!-- Interruptor para cambiar el estado de búsqueda -->
                            <div class="form-check form-switch form-check-reverse">
                                <label class="form-check-label" for="flexSwitchCheckReverse">Buscando</label>
                                <input class="form-check-input flexSwitchCheckReverse" type="checkbox" data-id="<?php echo $publicacion['id_seekfind']; ?>" <?php echo $publicacion['estado_usuario'] ? 'checked' : ''; ?>>
                            </div>
                            <!-- Mostrar información de la publicación -->
                            <h5 class="card-title">Nombre: <?php echo $publicacion['nom_tipo'], "-", $publicacion['nom_elemento'] ; ?></h5>
                            <p class="card-text">Descripción: <?php echo $publicacion['desc_elemento']; ?></p>
                            <p class="card-text">Departamento: <?php echo $publicacion['nom_depto']; ?></p>
                            <p class="card-text">Municipio: <?php echo $publicacion['nom_munic']; ?></p>
                            <p class="card-text">Sitio: <?php echo $publicacion['nom_sitio']; ?></p>
                            <p class="card-text">Descripción del sitio: <?php echo $publicacion['desc_sitio']; ?></p>
                            <p class="card-text">Fecha: <?php echo $publicacion['fecha']; ?></p>
                            <p class="card-text">Hora: <?php echo $publicacion['hora']; ?></p>
                            <!-- Botones para editar y deshabilitar publicaciones -->
                            <button type="button" class="btn btn-primary editarPublicacion" data-id="<?php echo $publicacion['id_seekfind']; ?>" data-nombre="<?php echo $publicacion['nom_tipo']; ?>">
                                Editar
                            </button>
                            <a href="eliminar_publicacion.php?id=<?php echo $publicacion['id_seekfind']; ?>" class="btn btn-danger">Deshabilitar</a>
                        </div>
                    </div>
                <?php endforeach; 
            endif; ?>
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
                <!-- Formulario para editar la publicación -->
                <form action="editar_publicacion.php" method="post">
                    <input type="hidden" id="publicacionId" name="id">
                    <!-- Campos para editar la publicación -->
                    <div class="form-group">
                        <label for="elemento">Elemento</label>
                        <input type="text" class="form-control" id="publicacionNombre" name="elemento">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>

                    <!-- Selección de departamento, municipio y sitio -->
                    <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                        <option value="">Departamento</option>      
                        <?php 
                        // Consulta para obtener los departamentos
                        $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                        $s_depto->execute();
                        $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                        
                        // Mostrar opciones de departamento
                        foreach($enc_depto as $depto)
                        {
                        ?>
                            <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option>
                        <?php
                        } ?>
                    </select>
                         
                    <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                        <option value="">Municipio</option>  
                    </select>
                         
                    <select class="form-select form-control bg-transparent" name="id_sitio" id="id_sitio" >
                        <option value="">Sitio</option>
                    </select>

                    <!-- Más campos para editar la publicación -->
                    <div class="form-group">
                        <label for="descripcion_sitio">Descripción del sitio</label>
                        <textarea class="form-control" id="descripcion_sitio" name="descripcion_sitio"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora">
                    </div>
                    <!-- Botón para guardar los cambios -->
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- libreria para el pop up de el checkbox -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/script.js"> </script>
<script src="../js/ajax_buscar_elementos.js"></script> 
<script src="../js/ajax_buscar_municipios.js"></script>
<script src="../js/ajax_buscar_sitios.js"></script> 
<script>
    // Se ejecuta cuando el contenido del DOM está completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los botones para editar publicaciones
        var editarPublicacionButtons = document.querySelectorAll('.editarPublicacion');
        editarPublicacionButtons.forEach(function(button) {
            // Añade un evento de clic a cada botón
            button.addEventListener('click', function() {
                // Recupera datos del elemento seleccionado
                var id = this.getAttribute('data-id');
                var nombre = this.getAttribute('data-nombre');
                // Asigna los valores recuperados a los campos del formulario en el modal
                document.getElementById('publicacionId').value = id;
                document.getElementById('publicacionNombre').value = nombre;
                // Los siguientes campos se llenan con datos PHP, que se supone son del elemento seleccionado
                document.getElementById('descripcion').value = '<?php echo $publicacion['desc_elemento']; ?>';
                document.getElementById('id_depto').value = '<?php echo $publicacion['nom_depto']; ?>';
                document.getElementById('id_munic').value = '<?php echo $publicacion['nom_munic']; ?>';
                document.getElementById('id_sitio').value = '<?php echo $publicacion['nom_sitio']; ?>';
                document.getElementById('descripcion_sitio').value = '<?php echo $publicacion['desc_sitio']; ?>';
                document.getElementById('fecha').value = '<?php echo $publicacion['fecha']; ?>';
                document.getElementById('hora').value = '<?php echo $publicacion['hora']; ?>';

                // Muestra el modal de edición
                var modal = new bootstrap.Modal(document.getElementById('editarPublicacionModal'));
                modal.show();
            });
        });

        // Selecciona todos los botones que cierran modales
        var cerrarModalButtons = document.querySelectorAll('[data-dismiss="modal"]');
        cerrarModalButtons.forEach(function(button) {
            // Añade un evento de clic a cada botón para cerrar el modal
            button.addEventListener('click', function() {
                var modalElement = button.closest('.modal');
                var modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            });
        });
    });

    // js para el pop up de el checkbox
    let checkboxes = document.querySelectorAll('.flexSwitchCheckReverse');

    checkboxes.forEach((checkbox) => {
        // Añade un evento de cambio a cada checkbox
        checkbox.addEventListener('change', function(e) {
            let id_seekfind = this.dataset.id;
            let estado_usuario = this.checked ? 1 : 0;

            // Si el checkbox se desmarca, muestra un pop-up de confirmación
            if (!this.checked) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Ya has encontrado tu elemento?',
                    showDenyButton: true,
                    confirmButtonText: `Si, lo he encontrado`,
                    denyButtonText: `No, aun no`,
                    customClass: {
                        confirmButton: 'btn btn-primary m-2 p-3',
                        denyButton: 'btn btn-danger m-2 p-3'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, actualiza el estado y envía una solicitud AJAX
                        this.checked = false;
                        estado_usuario = 0;

                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "u_estado_publicacion.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("id_seekfind=" + id_seekfind + "&estado_usuario=" + estado_usuario);

                        xhr.onload = function() {
                            if (xhr.status == 200) {
                                console.log("Respuesta recibida: " + xhr.responseText);
                            } else {
                                console.log("Error con la solicitud: " + xhr.status);
                            }
                        }

                    } else if (result.isDenied) {
                        // Si el usuario niega, revierte el estado del checkbox
                        this.checked = true;
                        estado_usuario = 1;
                    }
                })
            }
        });
    });
</script>
<!-- ... -->
</body>
</html>