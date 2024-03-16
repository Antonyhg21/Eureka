<?php
/*
CRUD con PostgreSQL y PHP
@Carlos Eduardo Perez Rueda
@Marzo de 2023
============================================================================================
Este archivo muestra un formulario que se envía a insertar.php, el cual guardará los datos
============================================================================================
*/
?>
<?php include_once "base_de_datos.php" ?>
<?php
$id_depto=$_POST['id_depto'];
?>
<div class="form-group">
<select required name="id_munic" id="id_munic" class="form-select form-control bg-transparent">
	<option value="">Municipo</option>
<?php
	$s_munic = $base_de_datos->prepare("SELECT id_depto, id_munic, nom_munic FROM tab_munics  WHERE a.id_depto = '$id_depto' ORDER BY 2");
	$s_munic->execute();
	$count = $s_munic->rowCount();
	echo $count;
	$enc_munic = $s_munic->fetchAll();
	foreach($enc_munic as $munic):
		echo '<option value="'.$munic["id_depto"].'">'.$munic["nom_munic"].'</option>';
	endforeach;
	?>
	</select>
	</div>
