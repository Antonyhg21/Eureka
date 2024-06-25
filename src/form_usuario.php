<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres para el contenido del documento -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Asegura una correcta visualización y zoom adecuado en dispositivos móviles -->
    <title>Formulario de Registro</title> <!-- Título de la página -->
    <link rel="icon" type="image/x-icon" href="../img/icon.ico" /> <!-- Icono de la pestaña del navegador -->
    <link rel="stylesheet" href="../css/styles.css"> <!-- Enlace a la hoja de estilos principal -->
    <link rel="stylesheet" href="../css/style-chek.css"> <!-- Enlace a una hoja de estilos adicional -->
    <script src="js/vali.js"></script> <!-- Enlace al script de validación de formulario -->
</head>
    
<?php 
    include_once "base_de_datos.php"; // Incluye la conexión a la base de datos
    // Preparación de la consulta SQL para obtener información de departamentos y municipios
    $s_depmun = $base_de_datos->prepare('SELECT a.id_depto, a.nom_munic, a.id_munic, b.nom_depto  FROM tab_munics as a, tab_deptos as b WHERE a.id_depto = b.id_depto  ORDER BY 2 asc');
    $s_depmun->execute(); // Ejecución de la consulta
    $enc_depmun = $s_depmun->fetchAll(PDO::FETCH_OBJ); // Almacenamiento de los resultados como objetos
?>

<body class="bg-image"> <!-- Clase para aplicar imagen de fondo desde CSS -->
    <div class="container mt-5"> <!-- Contenedor principal para centrar el formulario en la página -->
        <div class="row justify-content-center"> <!-- Fila para alinear el formulario al centro -->
            <div class="col-md-5 col-md-4"> <!-- Columna para definir el ancho del formulario -->
                <div class="card card-form"> <!-- Tarjeta que contiene el formulario -->
                    <div class="card-header text-center">
                        <h4>Registro de Usuario</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <!-- Formulario para el registro de usuario -->
                        <form id="formulario_registro" action="ins_usuario.php" method="post" onsubmit="validarCorreoYEnviarFormulario(event)">                            <!-- Campos de entrada para información del usuario -->
                            <input type="email" class="form-control" name="email_usuario" id="email_usuario" placeholder="Correo Electrónico" required>
                            <input type="text" class="form-control" name="doc_usuario" id="doc_usuario" placeholder="Documento" required>
                            <input type="text" class="form-control" name="nom_usuario" id="nom_usuario" placeholder="Nombre" required>
                            <input type="text" class="form-control" name="ape_usuario" id="ape_usuario" placeholder="Apellido" required>
                            <input type="password" class="form-control" name="pass_usuario" id="pass_usuario" placeholder="Contraseña" required>
                            <input type="text" class="form-control" name="cel_usuario" id="cel_usuario" placeholder="Número de Celular" required>
                            <input type="text" class="form-control" name="dir_usuario" id="dir_usuario" placeholder="Dirección de Residencia" required>

                            <!-- Selector de departamento -->
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">Departamento</option>      
                                <?php 
                                // Consulta SQL para obtener los departamentos
                                $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                                $s_depto->execute(); // Ejecución de la consulta
                                $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC); // Almacenamiento de los resultados
                                
                                // Bucle para mostrar cada departamento como una opción en el selector
                                foreach($enc_depto as $depto)
                                {
                                ?>
                                    <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option>
                                <?php
                                } ?>
                            </select>
                                 
                            <!-- Selector de municipio (se llena dinámicamente con JavaScript) -->
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="">Municipio</option>  
                            </select>

                            <div class="form-group text-center btn-container">
                                <!-- Botón para enviar el formulario -->
                                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="../js/ajax_buscar_municipios.js"></script> <!-- Enlace al script para cargar dinámicamente los municipios según el departamento seleccionado -->
    
    <script>
        // En tu archivo JS (puedes agregar esto en vali.js o en un nuevo archivo JS)
        function validarCorreoYEnviarFormulario(event) {
            event.preventDefault(); // Detiene el envío del formulario
            const email = document.getElementById('email_usuario').value;
            const formData = new FormData();
            formData.append('email_usuario', email);
        
            fetch('verificar_email.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if(data.existe) {
                    alert("El correo electrónico ya está en uso.");
                } else {
                    // Si el correo no existe, enviar el formulario
                    alert("Welcome to International Finders Community");
                    document.getElementById('formulario_registro').submit();
                }
            })
            .catch(error => console.error('Error:', error));
        }

    </script>
</body>
</html>