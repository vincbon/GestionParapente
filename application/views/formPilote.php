<form class="col-lg-offset-2 col-lg-6 form-horizontal" action="<?php echo base_url("pilotes")."/".$function; ?>" method='POST'>

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
<legend>Informations de pilote</legend>
<!-- Text input-->
<?php
  $critere = 'no_licence';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Numéro de licence</label>  
  <div class="col-md-4">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="20" required>
    
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'qualification_biplace';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Qualification Biplace</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (isset($contenuCritere) && ($contenuCritere == 't')) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'niveau';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="niveaux">Niveau</label>
  <div class="col-md-7"> 
    <label class="radio-inline" for="<?php echo $critere ?>-0">
      <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="vert" <?php if (isset($contenuCritere) && ($contenuCritere == 'vert')) {echo 'checked';} ?> type="radio" checked>
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
    <a href="<?php echo base_url("pilotes") ?>">
      <button type="button" class="btn btn-danger">
        Annuler
      </button>
    </a>
  </div>
</div>
</form>