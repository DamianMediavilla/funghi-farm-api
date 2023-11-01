
<form action="" method='POST'  enctype="multipart/form-data" class="container">

    <fieldset ><legend  >Datos Basicos</legend>

        <label for="numero">Numero de entrevista</label>
        <input type="number" class="" id="numero" name="numero" value="<?php echo (isset($encuesta) ?  $encuesta->numero :  '') ?>" required>
        <label for="edad">Edad</label>
        <input type="number" class="" id="edad" name="edad" value="<?php echo (isset($encuesta) ?  $encuesta->edad :  '') ?>" required>
        <label for="sexo">Sexo</label>
        <select name="sexo" id="">
            <option value="-" selected disabled>Seleccionar Opcion</option>
            <option value="M" <?php echo (isset($encuesta) ?  (($encuesta->sexo=='M')? 'selected' : '') :  '') ?>>Masculino</option>
            <option value="F"<?php echo (isset($encuesta) ?  (($encuesta->sexo=='F')? 'selected' : '') :  '') ?>>Femenino</option>
            <option value="X"<?php echo (isset($encuesta) ?  (($encuesta->sexo=='X')? 'selected' : '') :  '') ?>>Otro</option>
        </select>
        <label for="region_origen">RegionOrigen (nacionalidad)</label>
        <input type="text" class="" id="region_origen" name="region_origen" value="<?php echo (isset($encuesta) ?  $encuesta->region_origen :  '') ?>">
        <label for="region_actual">Region actual o de Residencia</label>
        <input type="text" class="" id="region_actual" name="region_actual" value="<?php echo (isset($encuesta) ?  $encuesta->region_actual :  '') ?>">
        <label for="instrumento">Instrumento</label>
        <input type="text" class="" id="instrumento" name="instrumento" value="<?php echo (isset($encuesta) ?  $encuesta->instrumento :  '') ?>">
        <label for="estudios">Estudios</label>
        <select  name="estudios[]" id="estudios">
            <option value="Secundario" selected disabled>Seleccionar Opcion</option>
            <option value="Estudiante" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Estudiante')? 'selected' : '') :  '') ?> >Estudiante</option> 
            <option value="Tecnicatura" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Tecnicatura')? 'selected' : '') :  '') ?> >Tecnicatura</option> 
            <option value="Licenciado" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Licenciado')? 'selected' : '') :  '') ?> >Licenciado</option> 
            <option value="Docente" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Docente')? 'selected' : '') :  '') ?> >Formacion Docente</option> 
            <option value="Master" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Master')? 'selected' : '') :  '') ?> >Master</option> 
            <option value="Doctorado" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Doctorado')? 'selected' : '') :  '') ?> >Doctorado</option> 
            <option value="Formacion Particular/Privada" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='Formacion Particular/Privada')? 'selected' : '') :  '') ?> >Formacion Particular/Privada</option> 
            <option value="No especifica" <?php echo (isset($encuesta) ?  (($encuesta->estudios=='No especifica')? 'selected' : '') :  '') ?> >No especifica</option> 
        </select>
    </fieldset>

    <?php include "../sinto.html"?>
    <legend>Lesiones</legend>
    <input name="lesion" type="text" placeholder="Ej: Tendinitis" value="<?php echo (isset($encuesta) ?  $encuesta->lesion :  '') ?>">
</fieldset>

<fieldset>
    <legend>Medicación</legend>
    <input name="medicacion" type="text" placeholder="Ej: Ansiolíticos" value="<?php echo (isset($encuesta) ?  $encuesta->medicacion :  '') ?>">
</fieldset>

    <fieldset><legend>Info Adicional</legend>

        <label for="comentarios">Comentarios</label>
        <br>
        <textarea name="comentarios" id="comentarios" cols="70" rows="10"><?php echo (isset($encuesta) ?  $encuesta->comentarios :  '') ?></textarea>
    </fieldset>
    <div class="container mt-5 mb-5">

        <a href="/admin" class="btn btn-warning"  >Cancelar y volver atras</a>
        <input type="submit" value="Guardar" class="btn btn-success">
    </div>
</form>