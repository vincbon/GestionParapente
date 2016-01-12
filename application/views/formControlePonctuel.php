<form class=" col-lg-12 form-horizontal" action="<?php echo base_url("controlesponctuels")."/".$function; ?>" method='POST'>

<!-- Text input-->
<?php
  $critere = 'date';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Date</label>  
  <div class="col-md-2">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".date('d/m/Y', strtotime($contenuCritere))."\"";} ?> type="text" maxlength="32" autofocus required>
    <span class="help-block small"><em>(jj/mm/aaaa)</em></span>
  </div>
</div>

<!-- Button -->
<?php
  $critere = 'parapente';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Parapente</label>
  <div class="col-md-3">
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
        <h4 class="modal-title">Choix du parapente</h4>
      </div>
      <div class="modal-body">
        <?php $this->view('table', array('title' => 'Parapentes', 
                                         'array_data' => $parapentes['data'],
                                         'fields_metadata' => $parapentes['metadata'],
                                         'array_headings' => $parapentes['headings'],
                                         'miscInfos' => $parapentes['misc'],
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
  $critere = 'voile';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Voile</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'suspentes';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Suspentes</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'freins';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Freins</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'sellette';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Sellette</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'accelerateur';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Accélérateur</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'trim';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Trim</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<?php
  $critere = 'casque';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Casque</label>
  <div class="col-md-5">
    <div class="checkbox" style="padding:0">
      <label class="checkbox" for="<?php echo $critere ?>-0">
        <input name="<?php echo $critere ?>" id="<?php echo $critere ?>-0" value="true" <?php if (!isset($contenuCritere) || (isset($contenuCritere) && ($contenuCritere == 't'))) {echo 'checked';} ?> type="checkbox">
      </label>
    </div>
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

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="<?php echo base_url("controlesponctuels") ?>">
      <button type="button" class="btn btn-danger">
        Annuler
      </button>
    </a>
  </div>
</div>
</form>