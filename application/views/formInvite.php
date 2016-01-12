<form class="col-lg-offset-2 col-lg-6 form-horizontal" action="<?php echo base_url("invites")."/".$function; ?>" method='POST'>

<fieldset>
<legend>Etat civil</legend>
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

<!-- Text input-->
<?php
  $critere = 'prenom';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Prénom</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" required>
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'date_de_naissance';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Date de naissance</label>  
  <div class="col-md-3">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".date('d/m/Y', strtotime($contenuCritere))."\"";} ?> type="text" maxlength="32" required maxlength="10">
    <span class="help-block small"><em>(jj/mm/aaaa)</em></span>
  </div>
</div>

</fieldset>
<fieldset>
<legend>Informations liées à la sécurité</legend>

<!-- Text input-->
<?php
  $critere = 'taille';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Taille</label>  
  <div class="col-md-3">
    <div class="input-group">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="3" required>
    <span class="input-group-addon">cm</span>
    </div>
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'poids';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Poids</label>  
  <div class="col-md-3">
    <div class="input-group">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="3" required>
    <span class="input-group-addon">kg</span>
    </div>
  </div>
</div>

</fieldset>
<fieldset>
<legend>Informations de contact</legend>

<!-- Text input -->
<?php
  $critere = 'adresse';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Adresse</label>  
  <div class="col-md-7">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="128" required>    
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

<!-- Text input -->
<?php
  $critere = 'code_postal';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Code postal</label>  
  <div class="col-md-2">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="5" required>
  </div>
</div>

<!-- Text input -->
<?php
  $critere = 'telephone';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="tel">Téléphone</label>  
  <div class="col-md-3">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="tel" maxlength="10" required>
  </div>
</div>
</fieldset>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="<?php echo base_url("invites") ?>">
      <button type="button" class="btn btn-danger">
        Annuler
      </button>
    </a>
  </div>
</div>
</form>