<?php
// Valeurs par défaut des variables $data
if (!isset($btnNouveau)) $btnNouveau = false;
if (!isset($btnSelect)) $btnSelect = false;
if (!isset($btnModif)) $btnModif = false;
if (!isset($btnInfos)) $btnInfos = false;
if (!isset($object)) $object = null;
if (!isset($show_false)) $show_false = null;

// Affiche au format HTML les informations complémentaires sur l'objet d'id $id contenues dans $miscInfos[$id].
if (!function_exists('scriptMiscInfos')) {
	function scriptMiscInfos($infos) {
		$res = "";
		
		if (isset($infos)) {
			foreach ($infos as $nom_info => $info) {
				$nom_info = str_replace('_', ' ', ucfirst($nom_info));
				$res.='<p><strong>'.$nom_info.' :</strong> '.$info.'</p>';
			}
		}

		return $res;
	}
}

foreach ($fields_metadata as $num_field => $field) {
	if ($field['type'] == 'boolean') {
		$bool_fields[] = $field['name'];
	} else if ($field['type'] == 'date') {
		$date_fields[] = $field['name'];
	} else if ($field['type'] == 'int4range') {
		$int4range_fields[] = $field['name'];
	}
}

if (isset($bool_fields) && !empty($bool_fields)) {
	foreach ($array_data as $num_row => $row) {
		foreach ($bool_fields as $field_name) {
			if ($row[$field_name] == 't') {
				$array_data[$num_row][$field_name] = $this->config->item('bool_display')['true'];
			} else {
				$array_data[$num_row][$field_name] = $this->config->item('bool_display')['false'];
			}
		}
	}
}

if (isset($date_fields) && !empty($date_fields)) {
	foreach ($array_data as $num_row => $row) {
		foreach ($date_fields as $field_name) {
			$array_data[$num_row][$field_name] = date('d/m/Y', strtotime($row[$field_name]));
		}
	}
}

if (isset($int4range_fields) && !empty($int4range_fields)) {
	foreach ($array_data as $num_row => $row) {
		foreach ($int4range_fields as $field_name) {
			$tmp = trim($row[$field_name], '[]()');
    		$tmp = explode(',', $tmp);
    		$tmp[1]--;
			$array_data[$num_row][$field_name] = $tmp[0].' - '.$tmp[1];
		}
	}
}


$get_save = '';
foreach ($_GET as $id => $val) {
	if ($id != 'o') $get_save .= '&'.$id.'='.$val;
}

// Réinitialisation des index des données
$array_data_tmp = [];
foreach ($array_data as $num_row => $row) {
	foreach ($row as $value) {
		$array_data_tmp[$num_row][] = $value;
	}
}
$array_data = $array_data_tmp;

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<?php if ($btnNouveau) : ?>
			<a class="pull-right" href="<?php echo base_url().$this->router->fetch_class()."/ajouter" ?>">
				<button type="button" class="btn btn-success">Nouveau</button>
			</a>
		<?php endif ?>
		<span class="panel-title clearfix large"><span class="glyphicon glyphicon-list"></span> <?php echo $title; ?></span>
	</div>
	<table class="table table-bordered table-striped table-condensed">
		<tr>
			<?php foreach ($array_headings as $field => $heading) : ?>
				<th>
					<a href="<?php echo base_url().$this->router->fetch_class()."?o=".$field.$get_save; ?>" style="color:black">
						<?php 
							echo $heading;
							if (isset($_GET['o']) && $_GET['o'] == $field) {
								echo '<span class="fa fa-caret-up pull-right"></span>';
							}
						?>
					</a>
				</th>
			<?php endforeach ?>
			<?php
				if ($array_data != []) {
					if ($btnModif) {
						echo "<th></th>";
					}
					if ($btnSelect) {
						echo "<th></th>";
					}
					if ($btnInfos) {
						echo "<th></th>";
					}
				}
			?>	
		</tr>
		<?php foreach ($array_data as $num_row => $row) : ?>
			<tr id="<?php echo $object.'_'.$row[0] ?>" class="trb <?php if (isset($rows_false) && in_array($row, $rows_false, true)) echo 'danger' ?>">
				<?php foreach ($row as $num_field => $value) : ?>
					<td id="<?php echo $object.'_'.$row[0].'_'.$fields_metadata[$num_field]['name'] ?>"><?php echo $value; ?></td>
				<?php endforeach ?>
				<?php if ($btnSelect) : ?>
					<td>
						<button type="button" id="select_<?php echo $object.'_'.$row[0] ?>" class="btn btn-success btn-sm" data-dismiss="modal">Selectionner</button>
					</td>
				<?php endif ?>

				<?php if ($btnModif) : ?>
					<td>
						<a href="<?php echo base_url().$this->router->fetch_class()."/modifier/".$row[0] ?>">
							<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
						</a>
					</td>
				<?php endif ?>
				<?php if ($btnInfos) : ?>
					<td>
						<button type="button" id="pop_<?php echo $object.'.'.$row[0] ?>" class="btn btn-info btn-sm" data-toggle="popover"
								title="<h4>Informations compl&eacute;mentaires</h4>" data-html="true" data-content="<?php echo scriptMiscInfos($miscInfos[$row[0]]); ?>">
								<span class="glyphicon glyphicon-info-sign"></span>
						</button>
					</td>
				<?php endif ?>
			</tr>
		<?php endforeach ?>
	</table>
	<div class="panel-footer">
		<p class="help-block"><em>Nombre d'enregistrements : <?php echo count($array_data); ?></em></p>
	</div>
</div>
