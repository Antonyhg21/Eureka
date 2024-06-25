<?php
    // Incluye el archivo de conexión a la base de datos.
    include "base_de_datos.php";
    // Prepara una consulta SQL para obtener la información del usuario actual.
    $s_info_usuario = $base_de_datos->prepare("SELECT a.id_usuario, a.email_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, 
            a.dir_usuario, a.id_depto, b.nom_depto, a.id_munic, c.nom_munic 
            FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c 
            WHERE a.id_usuario = ? AND
                a.id_depto = b.id_depto AND
                a.id_munic = c.id_munic AND
                b.id_depto = c.id_depto;");
    // Ejecuta la consulta con el ID del usuario actual obtenido de la sesión.
    $s_info_usuario->execute([$_SESSION['usuario']]);
    // Obtiene el resultado de la consulta como un array asociativo.
    $enc_info_usuario = $s_info_usuario->fetch(PDO::FETCH_ASSOC);
?>

<div class="col-md-6">
    <h2>MIS DATOS</h2>
    <hr>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <!-- Muestra la información del usuario en una tabla -->
                <tr>
                    <th scope="row">E-mail:</th>
                    <td><?php echo $enc_info_usuario['email_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Documento:</th>
                    <td><?php echo $enc_info_usuario['doc_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Nombres:</th>
                    <td><?php echo $enc_info_usuario['nom_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Apellidos:</th>
                    <td><?php echo $enc_info_usuario['ape_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Celular:</th>
                    <td><?php echo $enc_info_usuario['cel_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Dirección:</th>
                    <td><?php echo $enc_info_usuario['dir_usuario']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Departamento:</th>
                    <td><?php echo $enc_info_usuario['nom_depto']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Municipio:</th>
                    <td><?php echo $enc_info_usuario['nom_munic']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Botón para abrir el modal de edición de información del usuario -->
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#editarUsuarioModal">
        Editar información
    </button>
</div>

<div class="col-md-3">
    <h2>EUREKA</h2>
    <hr>
    <!-- Imagen de perfil o logo -->
    <img src="../img/icon.png" alt="Imagen de perfil" class="img-thumbnail">
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar perfil</h5>
                <!-- Botón para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="editar_perfil.php" method="post">
                    <!-- Formulario para editar la información del usuario -->
                    <input type="hidden" name="id_usuario" value="<?php echo $enc_info_usuario['id_usuario']; ?>">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $enc_info_usuario['email_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento" value="<?php echo $enc_info_usuario['doc_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $enc_info_usuario['nom_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $enc_info_usuario['ape_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $enc_info_usuario['cel_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $enc_info_usuario['dir_usuario']; ?>">
                    </div>
                    <div class="form-group">
                        <!-- Selector de departamento, se llena con opciones desde la base de datos -->
                        <label for="departamento">Departamento</label>
                        <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                            <option value="">Departamento</option>      
                            <?php 
                            // Consulta para obtener todos los departamentos.
                            $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                            $s_depto->execute();
                            $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                            foreach($enc_depto as $depto)
                            {
                                // Crea una opción para cada departamento.
                                echo "<option value=\"{$depto['id_depto']}\">{$depto['nom_depto']}</option>";
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- Selector de municipio, se llena dinámicamente por medio de un AJAX basado en el departamento seleccionado -->
                        <label for="municipio">Municipio</label>
                        <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                            <option value="">Municipio</option>  
                        </select>
                    </div>
                    
                    <!-- Botón para enviar el formulario y guardar los cambios -->
                    <button type="submit" class="btn btn-primary mt-3">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../js/ajax_buscar_municipios.js"></script> <!-- Script para cargar municipios basado en el departamento seleccionado -->

<script>
    // Agrega eventos para manejar la apertura y cierre del modal de edición de usuario.
    document.addEventListener('DOMContentLoaded', function() {
        var editarUsuarioButton = document.querySelector('[data-target="#editarUsuarioModal"]');
        editarUsuarioButton.addEventListener('click', function() {
            // Muestra el modal de edición de usuario.
            var modal = new bootstrap.Modal(document.getElementById('editarUsuarioModal'));
            modal.show();
        });

        var cerrarModalButtons = document.querySelectorAll('[data-dismiss="modal"]');
        cerrarModalButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Cierra el modal de edición de usuario.
                var modalElement = button.closest('.modal');
                var modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            });
        });
    });
</script>