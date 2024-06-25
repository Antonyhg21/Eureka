<?php
// Incluir el archivo de conexión a la base de datos
include "base_de_datos.php";

// Preparar la consulta SQL para seleccionar publicaciones
$s_publicaciones = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_rol_usuario,  a.estado_usuario, a.id_usuario, b.nom_usuario, 
a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
WHERE a.id_usuario  = ?  AND
a.estado_usuario = true AND
a.id_usuario    = b.id_usuario AND
a.id_tipo       = c.id_tipo     AND
a.id_elemento   = d.id_elemento AND
d.id_tipo       = c.id_tipo     AND
a.id_depto      = e.id_depto    AND
a.id_munic      = f.id_munic    AND
f.id_depto      = e.id_depto    AND
a.id_sitio      = g.id_sitio    order by 20 desc LIMIT 20;');
// Ejecutar la consulta con el id de usuario de la sesión actual
$s_publicaciones->execute([$_SESSION['usuario']]);
// Obtener todas las publicaciones como un array asociativo
$enc_publicaciones = $s_publicaciones->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-9">
    <h2>Elementos en búsqueda</h2>
    <hr>
        <?php 
        // Verificar si el array de publicaciones está vacío
        if(empty($enc_publicaciones)): ?>
            <p>Aún no tienes elementos en búsqueda.</p>
        <?php else: 
            // Iterar sobre el array de publicaciones para mostrar cada una
            foreach ($enc_publicaciones as $publicacion): ?>
                <div class="card mb-3">
                    <div class="card-body" style="position: relative;">
                        <!-- Interruptor para cambiar el estado de búsqueda de la publicación -->
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
                        <!-- Botones para editar y deshabilitar la publicación -->
                        <button type="button" class="btn btn-primary editarPublicacion" data-id="<?php echo $publicacion['id_seekfind']; ?>">
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
            <div class="modal-body" id="cont_edit_publicacion">
                <!-- Formulario para editar la publicación, se llenará con datos mediante AJAX -->
                <form action="editar_publicacion.php" method="post">
                    <input type="hidden" id="publicacionId" name="id">
                    <!-- Campos del formulario -->
                    <div class="form-group">
                        <label for="elemento">Elemento</label>
                        <input type="text" class="form-control" id="publicacionNombre" name="elemento">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>

                    <!-- Selectores para departamento, municipio y sitio, se llenarán con datos mediante AJAX -->
                    <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                        <option value="">Departamento</option>      
                        <?php 
                        // Consulta para obtener todos los departamentos
                        $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                        $s_depto->execute();
                        $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                        
                        // Iterar sobre los departamentos para crear opciones del selector
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
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Librerías para el manejo de pop-ups y AJAX -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/script.js"> </script>
<script src="../js/ajax_buscar_elementos.js"></script> 
<script src="../js/ajax_buscar_municipios.js"></script>
<script src="../js/ajax_buscar_sitios.js"></script> 
<script>
    // Este script maneja la edición y cambio de estado de publicaciones en una página web.

    // Agrega un evento que se dispara cuando el contenido del DOM está completamente cargado.
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los botones para editar publicaciones.
        var editarPublicacionButtons = document.querySelectorAll('.editarPublicacion');
        // Itera sobre cada botón de edición de publicaciones.
        editarPublicacionButtons.forEach(function(button) {
            // Agrega un evento de clic a cada botón.
            button.addEventListener('click', function() {
                // Obtiene el ID de la publicación desde el atributo data-id del botón.
                var id = this.getAttribute('data-id');
                // Realiza una solicitud POST a 'carg_edit_publicaciones.php' con el ID de la publicación.
                fetch('carg_edit_publicaciones.php', {
                    method: 'POST',
                    body: JSON.stringify({ id_seekfind: id }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Llena el formulario de edición con los datos de la publicación obtenidos de la respuesta.
                    document.getElementById('publicacionId').value = data.id_seekfind;
                    document.getElementById('publicacionNombre').value = data.nom_elemento;
                    document.getElementById('descripcion').value = data.desc_elemento;
                    // Muestra el modal de edición de publicación.
                    var modal = new bootstrap.Modal(document.getElementById('editarPublicacionModal'));
                    modal.show();
                })
                .catch(error => console.error('Error:', error)); // Maneja errores de la solicitud.
            });
        });
    });

    // Maneja el cambio de estado de las publicaciones con una confirmación mediante un pop-up.
    let checkboxes = document.querySelectorAll('.flexSwitchCheckReverse');

    // Itera sobre cada checkbox de cambio de estado.
    checkboxes.forEach((checkbox) => {
        // Agrega un evento de cambio a cada checkbox.
        checkbox.addEventListener('change', function(e) {
            // Obtiene el ID de la publicación y el nuevo estado desde el checkbox.
            let id_seekfind = this.dataset.id;
            let estado_usuario = this.checked ? 1 : 0;

            // Si el checkbox es desmarcado, muestra un pop-up de confirmación.
            if (!this.checked) {
                e.preventDefault(); // Previene el cambio de estado por defecto.
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
                        // Si el usuario confirma, actualiza el estado de la publicación a inactivo.
                        this.checked = false;
                        estado_usuario = 0;

                        // Envia una solicitud AJAX para actualizar el estado de la publicación en el servidor.
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "u_estado_publicacion.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("id_seekfind=" + id_seekfind + "&estado_usuario=" + estado_usuario);

                        xhr.onload = function() {
                            if (xhr.status == 200) {
                                // Maneja la respuesta del servidor.
                                console.log("Respuesta recibida: " + xhr.responseText);
                            } else {
                                // Maneja errores de la solicitud.
                                console.log("Error con la solicitud: " + xhr.status);
                            }
                        }

                    } else if (result.isDenied) {
                        // Si el usuario niega, mantiene el estado de la publicación como activo.
                        this.checked = true;
                        estado_usuario = 1;
                    }
                })
            }
        });
    });
</script>