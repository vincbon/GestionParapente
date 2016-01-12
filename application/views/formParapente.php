<form class="col-lg-offset-2 col-lg-6 form-horizontal" action="<?php echo base_url("parapentes")."/".$function; ?>" method='POST'>

<fieldset>
<legend>Identification</legend>

<!-- Text input-->
<?php
  $critere = 'immatriculation';
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Immatriculation</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" autofocus required>
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'marque';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Marque</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" required>
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'modele';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Modèle</label>  
  <div class="col-md-5">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" required>
    
  </div>
</div>

</fieldset>

<fieldset>
<legend>Caractéristiques</legend>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'biplace';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Biplace</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (isset($contenuCritere) && ($contenuCritere == 't')) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'taille';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="selectbasic">Taille</label>
  <div class="col-md-3">
    <select id="selectbasic" name="selectbasic" class="form-control">
      <option value="XXS">XXS</option>
      <option value="XS">XS</option>
      <option value="S">S</option>
      <option value="M">M</option>
      <option value="M/L">M/L</option>
      <option value="L">L</option>
      <option value="XL">XL</option>
    </select>
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'ptv';
  if (isset($old_data[$critere])) {
    $tmp = trim($old_data[$critere], '[]()');
    $contenuCritere = explode(',', $tmp);
    $contenuCritere[1]--;
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Poids Total Volant (PTV)</label>  
  <div class="col-md-4">
    <div class="input-group">
      <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere[0]."\"";} ?> type="text" maxlength="3" required>
      <span class="input-group-addon">-</span>
      <input id="<?php echo $critere.'_tmp' ?>" name="<?php echo $critere.'_tmp' ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere[1]."\"";} ?> type="text" maxlength="3" required>
      <span class="input-group-addon">kg</span>
    </div>
    <p class="help-block"><em>(ex: 75-90)</em></p>
  </div>
</div>

</fieldset>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="<?php echo base_url("parapentes") ?>">
      <button type="button" class="btn btn-danger">
        Annuler
      </button>
    </a>
  </div>
</div>
</form>