<form class="form-horizontal" action="<?php echo base_url("locations"); ?>">
<fieldset>

<div class="form-group col-md-5">

<!-- Button -->
<?php
  $critere = 'pilote';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Pilote</label>
  <div class="col-md-6">
    <div class="input-group">
      <input id="select_<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control" <?php if (isset($contenuCritere)) echo 'value="'.$contenuCritere.'"' ?> type="text" readonly required>
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
        <h4 class="modal-title">Choix du pilote</h4>
      </div>
      <div class="modal-body">
        <?php $this->view('table', array('title' => 'Pilotes', 
                                         'array_data' => $pilotes['data'],
                                         'fields_metadata' => $pilotes['metadata'],
                                         'array_headings' => $pilotes['headings'],
                                         'miscInfos' => $pilotes['misc'],
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

<!-- Button -->
<?php
  $critere = 'parapente';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Parapente</label>
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

<!-- Button -->
<?php
  $critere = 'parcours';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Parcours</label>
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
        <h4 class="modal-title">Choix du parcours</h4>
      </div>
      <div class="modal-body">
        <?php $this->view('table', array('title' => 'Parcours', 
                                         'array_data' => $parcours['data'],
                                         'fields_metadata' => $parcours['metadata'],
                                         'array_headings' => $parcours['headings'],
                                         'miscInfos' => $parcours['misc'],
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

</div>
<div class="form-group col-md-4">

<!-- Button -->
<?php
  $critere = 'invite';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<?php echo $critere ?>">Invité</label>
  <div class="col-md-8">
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
        <h4 class="modal-title">Choix de l'invité</h4>
      </div>
      <div class="modal-body">
        <?php $this->view('table', array('title' => 'Invités', 
                                         'array_data' => $invites['data'],
                                         'fields_metadata' => $invites['metadata'],
                                         'array_headings' => $invites['headings'],
                                         'miscInfos' => $invites['misc'],
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

<!-- Text input-->
<?php
  $critere = 'date';
  unset($contenuCritere);
  if (isset($old_data[$critere])) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="<?php echo $critere ?>">Date</label>  
  <div class="col-md-4">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="date" maxlength="32">
    <span class="help-block small"><em>(jj/mm/aaaa)</em></span>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </div>
</div>

</div>

</fieldset>
</form>