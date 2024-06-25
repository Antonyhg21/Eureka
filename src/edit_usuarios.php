<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres para el documento HTML -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Hace que la web sea responsive -->
    <title>Formulario de Registro</title> <!-- Título de la página -->
    <link rel="icon" type="image/x-icon" href="../img/icon.ico" /> <!-- Icono de la pestaña del navegador -->
    <link rel="stylesheet" href="../css/styles.css"> <!-- Vincula una hoja de estilos CSS externa de bootstrap -->
    <link rel="stylesheet" href="../css/style-chek.css"> <!-- Vincula otra hoja de estilos CSS externa -->
    <script src="js/vali.js"></script> <!-- Vincula un archivo JavaScript para validación -->
</head>

<?php
if (!isset($_GET["id_usuario"])) // Verifica si se ha proporcionado un ID de usuario en la URL
{
    echo "No existe el Usuario a editar"; // Mensaje de error si no se proporciona el ID
    exit(); // Termina la ejecución del script
}

$id_usuario = $_GET["id_usuario"]; // Obtiene el ID del usuario de la URL
include_once "base_de_datos.php"; // Incluye el archivo de conexión a la base de datos
// Prepara una consulta SQL para obtener los datos del usuario por su ID
$sentencia = $base_de_datos->prepare('SELECT a.id_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, 
                    a.dir_usuario, a.id_depto, b.nom_depto, a.id_munic, c.nom_munic FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c 
                    WHERE (a.id_depto = b.id_depto) AND (a.id_munic = c.id_munic) AND (b.id_depto = c.id_depto) AND 
                    (a.id_usuario = ?) ORDER BY 3;');
$sentencia->execute([$id_usuario]); // Ejecuta la consulta con el ID del usuario
$usuarios = $sentencia->fetch(PDO::FETCH_ASSOC); // Obtiene los datos del usuario como un array asociativo

if (!$usuarios) // Verifica si se encontraron datos del usuario
{
    echo "¡No existe algún Usuario con ese ID!"; // Mensaje de error si no se encuentra el usuario
    exit(); // Termina la ejecución del script
}

// A partir de aquí, el código se ejecuta solo si se encontró el usuario
?>

<body class="bg-image"> <!-- Aplica un estilo de imagen de fondo al cuerpo de la página -->
    <div class="container mt-5"> <!-- Contenedor principal con margen superior -->
        <div class="row justify-content-center"> <!-- Fila con contenido centrado -->
            <div class="col-md-5 col-md-4"> <!-- Columna con anchura específica para diferentes tamaños de pantalla -->
                <div class="card card-form"> <!-- Tarjeta con estilo específico para formularios -->
                    <div class="card-header text-center"> <!-- Cabecera de la tarjeta con texto centrado -->
                        <h4>Actualiza tus datos.</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body"> <!-- Cuerpo de la tarjeta -->
                        <!-- Formulario para actualizar datos del usuario, envía los datos a 'u_usuarios.php' mediante POST -->
                        <form action="u_usuarios.php" method="post" onsubmit="return validarFormulario()"> 
                            <input value="<?php echo $usuarios['id_usuario'] ?>" type="hidden" class="form-control" name="email_usuario" id="email_usuario" placeholder="Correo Electrónico"  required > <!-- Campo oculto para el ID del usuario -->
                            <input value="<?php echo $usuarios['doc_usuario'] ?>" type="text" class="form-control" name="doc_usuario" id="doc_usuario" placeholder="Documento" required > <!-- Campo para el documento del usuario -->
                            <input value="<?php echo $usuarios['nom_usuario'] ?>" type="text" class="form-control" name="nom_usuario" id="nom_usuario" placeholder="Nombre" required > <!-- Campo para el nombre del usuario -->
                            <input value="<?php echo $usuarios['ape_usuario'] ?>" type="text" class="form-control" name="ape_usuario" id="ape_usuario" placeholder="Apellido" required > <!-- Campo para el apellido del usuario -->
                            <input value="<?php echo $usuarios['cel_usuario'] ?>" type="text" class="form-control" name="cel_usuario" id="cel_usuario" placeholder="Número de Celular" required > <!-- Campo para el celular del usuario -->
                            <input value="<?php echo $usuarios['dir_usuario'] ?>" type="text" class="form-control" name="dir_usuario" id="dir_usuario" placeholder="Dirección de Residencia" required > <!-- Campo para la dirección del usuario -->
                        
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto"> <!-- Selector para el departamento del usuario -->
                                <option value="<?php echo $usuarios['id_depto']?>"><?php echo $usuarios['nom_depto']?></option> <!-- Opción predeterminada con el departamento actual del usuario -->     
                                <?php 
                                $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2'); // Prepara consulta para obtener todos los departamentos
                                $s_depto->execute(); // Ejecuta la consulta
                                $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC); // Obtiene todos los departamentos como un array asociativo
                                
                                foreach($enc_depto as $depto) // Bucle para mostrar cada departamento como una opción
                                {
                                ?>
                                    <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option> <!-- Opción para cada departamento -->
                                <?php
                                } ?>
                            </select>
                            
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic"> <!-- Selector para el municipio del usuario -->
                                <option value="<?php echo $usuarios['id_munic']?>"><?php echo $usuarios['nom_munic']?></option> <!-- Opción predeterminada con el municipio actual del usuario -->

                            <div class="form-group text-center btn-container"> <!-- Contenedor para el botón, centrado -->
                                <button type="submit" class="btn btn-primary" onclick="alert('Cambios guardados con éxito.')">Guardar cambios</button> <!-- Botón para enviar el formulario -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Vincula un archivo JavaScript para cargar dinámicamente los municipios basados en el departamento seleccionado -->
    <script src="../js/ajax_buscar_municipios.js"></script>

</body>
</html>