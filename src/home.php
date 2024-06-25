<?php 
include_once "encabezado.php"; // Incluye el archivo de encabezado
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres para el documento HTML -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Asegura la correcta visualización en dispositivos móviles -->
    <title>EUREKA!</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../css/styles.css"> <!-- Enlace a la hoja de estilos CSS -->
</head>

<?php
    include "base_de_datos.php"; // Incluye el archivo para la conexión a la base de datos
    // Prepara la consulta SQL para obtener los elementos extraviados, incluyendo información del usuario, tipo de elemento, elemento, departamento, municipio y sitio
    $sentencia = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_usuario, b.nom_usuario, 
        a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
        d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
        f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
    FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
        tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
    WHERE a.id_usuario  = b.id_usuario  AND
        a.estado_usuario = true AND
        a.id_tipo       = c.id_tipo     AND
        a.id_elemento   = d.id_elemento AND
        d.id_tipo       = c.id_tipo     AND
        a.id_depto      = e.id_depto    AND
        a.id_munic      = f.id_munic    AND
        f.id_depto      = e.id_depto    AND
        a.id_sitio      = g.id_sitio    order by 18 desc LIMIT 20;');
    $sentencia->execute(); // Ejecuta la consulta
    $d_seekfind = $sentencia->fetchAll(PDO::FETCH_OBJ); // Almacena los resultados como objetos

?>

<body class="body"> <!-- Clase para estilos del cuerpo de la página -->
    <br><br><br>
    <h2 class="text-center text-white"> <!-- Título de la sección -->
        Elementos Extraviados en tu zona.
    </h2>
    <div class="container">     <!-- Contenedor principal -->
        <div class="row">       <!-- Fila para organizar las tarjetas de elementos extraviados -->
            <?php 
            // Bucle para mostrar las publicaciones de elementos extraviados, incluyendo información del tipo de elemento, elemento, municipio y sitio
            foreach($d_seekfind as $seekfind)
            {
            ?>
                <div class="col-md-6">                  <!-- Columna para cada tarjeta de elemento extraviado -->
                    <div class="card bg-light mb-3">    <!-- Tarjeta para el elemento extraviado -->
                        <div class="card-body">         <!-- Cuerpo de la tarjeta -->
                            <h5 class="card-title"><?php echo $seekfind->nom_tipo; ?> - <?php echo $seekfind->nom_elemento; ?></h5>         <!-- Título de la tarjeta -->
                            <h6 class="card-subtitle mb-2 text-muted">Lugar: <?php echo $seekfind->nom_munic; ?> - <?php echo $seekfind->nom_sitio; ?></h6>     <!-- Subtítulo de la tarjeta -->
                            <p class="card-text"><?php echo $seekfind->desc_sitio; ?></p>       <!-- Descripción del sitio donde se encontró el elemento extraviado -->
                            <a href="form_seekfind.php" class="btn btn-primary">He encontrado algo similar</a>      <!-- Botón para reportar un elemento encontrado similar -->
                        </div>
                    </div>
                </div>
            <?php
            } 
            ?>
        </div>
    </div>
    <?php 
    include_once "footer.php"; // Incluye el archivo de pie de página
?>
</body>
</html>