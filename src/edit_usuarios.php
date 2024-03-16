<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="icon" type="image/x-icon" href="../img/icon.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-chek.css">
    <script src="js/vali.js"></script>
</head>

<?php
/*
CRUD con PostgreSQL y PHP
@Carlos Eduardo Perez Rueda
@date 2023-05-10
======================================================================================================
Este archivo muestra un formulario llenado automáticamente desde el ID pasado por la URL) para editar
======================================================================================================
 */

if (!isset($_GET["id_usuario"]))
{
	echo "No existe el Usuario a editar";
	exit();
}

$id_usuario = $_GET["id_usuario"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare('SELECT a.id_usuario, a.doc_usuario, a.nom_usuario, a.ape_usuario, a.cel_usuario, 
                    a.dir_usuario, a.id_depto, b.nom_depto, a.id_munic, c.nom_munic FROM tab_usuarios AS a, tab_deptos AS b, tab_munics AS c 
                    WHERE (a.id_depto = b.id_depto) AND (a.id_munic = c.id_munic) AND (b.id_depto = c.id_depto) AND 
                    (a.id_usuario = ?) ORDER BY 3;');
$sentencia->execute([$id_usuario]);
$usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$usuarios)
{
    #No existe
    echo "¡No existe algún Usuario con ese ID!";
    exit();
}

#Si el usuario existe, se ejecuta esta parte del código

?>

<body class="bg-image">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Actualiza tus datos.</h4>
                    </div>
                    <div class="card-body">
                        <form action="u_usuarios.php" method="post" onsubmit="return validarFormulario()">
                            <input value="<?php echo $usuarios['id_usuario'] ?>" type="hidden" class="form-control" name="email_usuario" id="email_usuario" placeholder="Correo Electrónico"  required >
                            <input value="<?php echo $usuarios['doc_usuario'] ?>" type="text" class="form-control" name="doc_usuario" id="doc_usuario" placeholder="Documento" required >
                            <input value="<?php echo $usuarios['nom_usuario'] ?>" type="text" class="form-control" name="nom_usuario" id="nom_usuario" placeholder="Nombre" required >
                            <input value="<?php echo $usuarios['ape_usuario'] ?>" type="text" class="form-control" name="ape_usuario" id="ape_usuario" placeholder="Apellido" required >
                            <input value="<?php echo $usuarios['cel_usuario'] ?>" type="text" class="form-control" name="cel_usuario" id="cel_usuario" placeholder="Número de Celular" required >
                            <input value="<?php echo $usuarios['dir_usuario'] ?>" type="text" class="form-control" name="dir_usuario" id="dir_usuario" placeholder="Dirección de Residencia" required >
                        
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="<?php echo $usuarios['id_depto']?>"><?php echo $usuarios['nom_depto']?></option>      
                                <?php 
                                $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                                $s_depto->execute();
                                $count= $s_depto->rowCount();
                                $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach($enc_depto as $depto)
                                {
                                ?>
                                    <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option>
                                <?php
                                } ?>
                            </select>
                            
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="<?php echo $usuarios['id_munic']?>"><?php echo $usuarios['nom_munic']?></option>

                            <div class="form-group text-center btn-container">
                                <button type="submit" class="btn btn-primary" onclick="alert('Cambios guardados con éxito.')">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="../js/ajax_buscar_municipios.js"></script>

</body>
</html>