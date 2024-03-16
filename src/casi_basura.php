<!-- select de departamentos -->
<select class="form-select form-control bg-transparent" name="lista_deptos" id="lista_deptos">
    <?php foreach($enc_depto as $depto)
    {
    ?>
        <option value="<?php echo $depto->id_depto?>"><?php echo $depto->nom_depto?></option>
    <?php
     } ?>
</select>