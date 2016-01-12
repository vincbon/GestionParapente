<form class="form-horizontal" action="<?php echo base_url("controlesrecurrents"); ?>">
<fieldset>

<div class="form-group col-md-5">

<!-- Button -->
<?php
  $critere = 'location';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Location</label>
  <div class="col-md-6">
    <div class="input-group">
      <input id="select_<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control" <?php if (isset($contenuCritere)) echo 'value="'.$contenuCritere.'"' ?> type="text" readonly>
      <div class="input-group-btn">
        <button type="button"  href="#modal_select_<?php echo $critere ?>" class="btn btn-default" data-toggle="modal">
          <span class="glyphicon glyphicon-list"></span>
          Parcourir
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-wide" id="modal_select_<?php echo $critere ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h4 class="modal-title">Choix de la location</h4>
      </div>
      <div class="modal-body">
        <?php $this->view('table', array('title' => 'Locations', 
                                         'array_data' => $locations['data'],
                                         'fields_metadata' => $locations['metadata'],
                                         'array_headings' => $locations['headings'],
                                         'miscInfos' => $locations['misc'],
                                         'btnSelect' => true,
                                         'btnInfo' => true,
                                         'object' => $critere,
                                         'btnNouveau' => false
                                         ))
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'resultat';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Résultat</label>
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
  $critere = 'voile';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Voile</label>
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
  $critere = 'suspentes';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Suspentes</label>
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
  $critere = 'freins';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Freins</label>
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

</div> <!-- Fin du form groupe -->

<div class="form-group col-md-4">

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'sellette';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Sellette</label>
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
  $critere = 'accelerateur';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Accélérateur</label>
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
  $critere = 'trim';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Trim</label>
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
  $critere = 'casque';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Casque</label>
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
