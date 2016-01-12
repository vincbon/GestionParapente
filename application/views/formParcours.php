<form class="col-lg-offset-2 col-lg-6 form-horizontal" action="<?php echo base_url("parcours")."/".$function; ?>" method='POST'>

<fieldset>
<legend>Localisation</legend>
<!-- Text input-->
<?php
  $critere = 'nom';
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Nom</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="36" autofocus required>
    
  </div>
</div>

<!-- Text input -->
<?php
  $critere = 'ville';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Ville</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" required>
    
  </div>
</div>
</fieldset>

<fieldset>
<legend>Description</legend>

<!-- Textarea -->
<?php
  $critere = 'site_decollage';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Site de décollage</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="<?php echo $critere ?>" name="<?php echo $critere ?>" required><?php if (isset($contenuCritere)) {echo $contenuCritere;} ?></textarea>
    <p class="help-block small">Vous pouvez agrandir ce champ.</p>
  </div>
</div>

<!-- Textarea -->
<?php
  $critere = 'site_atterrissage';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Site d'atterrissage</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="<?php echo $critere ?>" name="<?php echo $critere ?>" required><?php if (isset($contenuCritere)) {echo $contenuCritere;} ?></textarea>
    <p class="help-block small">Vous pouvez agrandir ce champ.</p>
  </div>
</div>

<!-- Textarea -->
<?php
  $critere = 'commentaire';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Commentaire</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="<?php echo $critere ?>" name="<?php echo $critere ?>"><?php if (isset($contenuCritere)) {echo $contenuCritere;} ?></textarea>
    <p class="help-block small">Vous pouvez agrandir ce champ.</p>
  </div>
</div>

</fieldset>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="<?php echo base_url("parcours") ?>">
      <button type="button" class="btn btn-danger">
        Annuler
      </button>
    </a>
  </div>
</div>
</form>