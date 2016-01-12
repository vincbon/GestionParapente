<form class="form-horizontal" action="<?php echo base_url("parapentes"); ?>">
<fieldset>

<div class="form-group col-md-5">

<!-- Text input-->
<?php
  $critere = 'immatriculation';
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Immatriculation</label>  
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32" autofocus>
    
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
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32">
    
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
  <div class="col-md-6">
  <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="32">
    
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'taille';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Taille</label>
  <div class="col-md-3">
    <select id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control">
      <option value=""></option>
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

</div> <!-- Fin du form groupe -->
<div class="form-group col-md-4">

<!-- Text input-->
<?php
  $critere = 'ptv';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Poids Total Volant</label>  
  <div class="col-md-4">
    <div class="input-group">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="4">
    <span class="input-group-addon">kg</span>
    </div>
  </div>
</div>

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
  <div class="col-md-6"> 
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
  $critere = 'en_etat_de_voler';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">En état de voler</label>
  <div class="col-md-6"> 
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

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-5 control-label" for="submit"></label>
  <div class="col-md-7">
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </div>
</div>

</div> <!-- Fin du formgroup -->
</fieldset>
</form>
