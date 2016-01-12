<form class="form-horizontal" action="<?php echo base_url("invites"); ?>">
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