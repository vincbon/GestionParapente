<form class="form-horizontal" action="<?php echo base_url("pilotes"); ?>">
<fieldset>

<div class="form-group col-md-5">

<!-- Text input-->
<?php
  $critere = 'nom';
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Nom</label>  
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="36" autofocus>
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'prenom';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Prénom</label>  
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32">
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'no_licence';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Numéro de licence</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="20">
    
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'qualification_biplace';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Qualification Biplace</label>
  <div class="col-md-5"> 
    <label class="radio-inline" for="<?php echo $critere ?>-0">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (isset($contenuCritere) && ($contenuCritere == 'true')) {echo 'checked';} ?> type="radio">
      <span class="glyphicon glyphicon-ok"></span>
    </label> 
    <label class="radio-inline" for="<?php echo $critere ?>-1">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-1" value="false" <?php if (isset($contenuCritere) && ($contenuCritere == 'false')) {echo 'checked';} ?> type="radio">
      <span class="glyphicon glyphicon-remove"></span>
    </label>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'niveau';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Niveau</label>
  <div class="col-md-7"> 
    <label class="radio-inline" for="<?php echo $critere ?>-0">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="vert" <?php if (isset($contenuCritere) && ($contenuCritere == 'vert')) {echo 'checked';} ?> type="radio">
      Vert
    </label> 
    <label class="radio-inline" for="<?php echo $critere ?>-1">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-1" value="bleu" <?php if (isset($contenuCritere) && ($contenuCritere == 'bleu')) {echo 'checked';} ?> type="radio">
      Bleu
    </label> 
    <label class="radio-inline" for="<?php echo $critere ?>-2">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-2" value="marron" <?php if (isset($contenuCritere) && ($contenuCritere == 'marron')) {echo 'checked';} ?> type="radio">
      Marron
    </label>
  </div>
</div>

</div> <!-- Fin du form groupe -->

<div class="form-group col-md-4">

<!-- Text input -->
<?php
  $critere = 'adresse';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<?php echo $critere ?>">Adresse</label>  
  <div class="col-md-8">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="128">    
  </div>
</div>

<!-- Text input -->
<?php
  $critere = 'ville';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<?php echo $critere ?>">Ville</label>  
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32">
    
  </div>
</div>

<!-- Text input -->
<?php
  $critere = 'code_postal';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<?php echo $critere ?>">Code postal</label>  
  <div class="col-md-3">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="5">
    
  </div>
</div>

<!-- Text input -->
<?php
  $critere = 'telephone';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<php echo $critere ?>">Téléphone</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="tel" maxlength="10" minlength="10"/>
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </div>
</div>

</div> <!-- Fin du formgroup -->
</fieldset>
</form>
