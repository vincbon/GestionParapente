<form class=" col-lg-offset-2 col-lg-6 form-horizontal" action="<?php echo base_url("locations")."/".$function; ?>" method='POST'>

<!-- Button -->
<?php
  $critere = 'pilote';
  unset($contenuCritere);
  if (isset($old_data)) {
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
  if (isset($old_data)) {
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
        <?php 
        $data_corrected = [];
        foreach($parapentes['data'] as $num_row => $row) {
          if ($row['en_etat_de_voler'] == 't') $data_corrected[$num_row] = $row;
        }
              $this->view('table', array('title' => 'Parapentes', 
                                         'array_data' => $data_corrected,
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
  $critere = 'invite';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Invité</label>
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

<!-- Button -->
<?php
  $critere = 'parcours';
  unset($contenuCritere);
  if (isset($old_data)) {
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
  <div class="col-md-4">
    <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".date('d/m/Y', strtotime($contenuCritere))."\"";} ?> type="date" maxlength="32" required>
    <span class="help-block small"><em>(jj/mm/aaaa)</em></span>
  </div>
</div>

<!-- Text input-->
<?php
  $critere = 'duree';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Durée</label>  
  <div class="col-md-4">
    <div class="input-group">
      <input id="<?php echo $critere?>_h" name="<?php echo $critere?>_h" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere[0]."\"";} ?> type="text" maxlength="3" required>
      <span class="input-group-addon">h</span>
      <input id="<?php echo $critere?>_mn" name="<?php echo $critere?>_mn" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere[1]."\"";} ?> type="text" maxlength="2" required>
      <span class="input-group-addon">mn</span>
    </div>
  </div>
</div>

<!-- Choix du tarif -->
<div class="form-group">
  <label class="col-md-5 control-label" for="tarif">Tarif</label>
    <div class="col-md-6">
      <select id="tarif" name="tarif" class="form-control">
        <?php foreach ($tarifs as $num_tarif => $tarif) : ?>
          <option value="<?php echo $tarif['coefficient'] ?>"><?php echo $tarif['libelle'].' : '.$tarif['coefficient'].' € / mn' ?></option>
        <?php endforeach; ?>
      </select>
    </div>
</div>

<!-- Text input-->
<?php
  $critere = 'prix';
  unset($contenuCritere);
  if (isset($old_data)) {
    $contenuCritere = $old_data[$critere];
  }
?>
<div class="form-group">
  <label class="col-md-5 control-label" for="<?php echo $critere ?>">Prix</label>  
  <div class="col-md-3">
    <div class="input-group">
      <input id="<?php echo $critere ?>" name="<?php echo $critere ?>" class="form-control input-sm" <?php if (isset($contenuCritere)) {echo "value=\"".$contenuCritere."\"";} ?> type="text" maxlength="4" required readonly>
      <span class="input-group-addon">€</span>
    </div>
  </div>
</div>

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