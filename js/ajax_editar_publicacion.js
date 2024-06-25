document.addEventListener('DOMContentLoaded', function() {
    var editarPublicacionButtons = document.querySelectorAll('.editarPublicacion');
    editarPublicacionButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var nombre = this.getAttribute('data-nombre');
            document.getElementById('publicacionId').value = id;
            document.getElementById('publicacionNombre').value = nombre;
            document.getElementById('descripcion').value = '<?php echo $publicacion["desc_elemento"]; ?>';
            document.getElementById('id_depto').value = '<?php echo $publicacion["nom_depto"]; ?>';
            document.getElementById('id_munic').value = '<?php echo $publicacion["nom_munic"]; ?>';
            document.getElementById('id_sitio').value = '<?php echo $publicacion["nom_sitio"]; ?>';
            document.getElementById('descripcion_sitio').value = '<?php echo $publicacion["desc_sitio"]; ?>';
            document.getElementById('fecha').value = '<?php echo $publicacion["fecha"]; ?>';
            document.getElementById('hora').value = '<?php echo $publicacion["hora"]; ?>';

            var modal = new bootstrap.Modal(document.getElementById('editarPublicacionModal'));
            modal.show();
        });
    });

    var editarUsuarioButton = document.querySelector('[data-target="#editarUsuarioModal"]');
    editarUsuarioButton.addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('editarUsuarioModal'));
        modal.show();
    });

    var cerrarModalButtons = document.querySelectorAll('[data-dismiss="modal"]');
    cerrarModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var modalElement = button.closest('.modal');
            var modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
        });
    });
});
