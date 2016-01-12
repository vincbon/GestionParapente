<form class="form-horizontal" action="<?php echo base_url("parcours"); ?>">
<fieldset>

<!-- Text input-->
<?php
  $critere = 'nom';
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group col-lg-3">
  <label class="col-md-3 control-label" for="<?php echo $critere ?>">Nom</label>  
  <div class="col-md-9">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" autofocus <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="36">
    
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
<div class="form-group col-lg-3">
  <label class="col-md-3 control-label" for="<?php echo $critere ?>">Ville</label>  
  <div class="col-md-9">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group col-lg-3">
  <label class="control-label" for="submit"></label>
  <div class="col-md-12">
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </div>
</div>

</fieldset>
</form>