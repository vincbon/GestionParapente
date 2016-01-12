<div class="col-md-5">

	<!-- Chiffre d'affaires -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="glyphicon glyphicon-euro"></span> Chiffre d'affaires</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo round($infos['chiffre']['total'], 2) ?> €
			</p>
			<p>
				<strong>Moyen par mois : </strong>
				<?php echo round($infos['chiffre']['CA_moyen_mois'], 2) ?> €
			</p>
			<p>
				<strong>30 derniers jours : </strong>
				<?php echo round($infos['chiffre']['CA_30_jours'], 2) ?> €
			</p>
		</div>
	</div>

	<!-- Locations -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="glyphicon glyphicon-list-alt"></span> Locations</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo $infos['locations']['total'] ?>
			</p>
			<p>
				<strong>Moyenne par mois : </strong>
				<?php echo round($infos['locations']['parMois'], 2) ?>
			</p>
			<p>
				<strong>CA moyen par location: </strong>
				<?php echo round($infos['locations']['CA_moyen_location'], 2) ?> €
			</p>
		</div>
	</div>

	<!-- Parapentes -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="glyphicon glyphicon-send"></span> Parapentes</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo $infos['parapentes']['total'] ?>
			</p>

			<!-- Parapente le plus loué -->
			<?php if ($infos['parapentes']['plusLoueResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parapentes']['plusLoueResult']['data'][0];
				}
			?>
			<p>
				<strong>Le plus loué : </strong><br/>
				<?php if ($carac == null) : ?>
					Aucun parapente enregistré
				<?php else : ?>
					<?php echo $carac['immatriculation'] ?> - <?php echo ucfirst($carac['marque']) ?> <?php echo ucfirst($carac['modele']) ?> <a href="<?php echo base_url("parapentes/?immatriculation=").$carac['immatriculation'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['parapentes']['nbPlusLoue'] ?> location<?php if ($infos['parapentes']['nbPlusLoue'] > 1) echo 's' ?>)</em>
				<?php endif ?>
			</p>

			<!-- Parapente le moins loué -->
			<?php if ($infos['parapentes']['moinsLoueResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parapentes']['moinsLoueResult']['data'][0];
				}
			?>
			<p>
				<strong>Le moins loué : </strong><br/>
				<?php if ($carac == null) : ?>
					Aucun parapente enregistré
				<?php else : ?>
					<?php echo $carac['immatriculation'] ?> - <?php echo ucfirst($carac['marque']) ?> <?php echo ucfirst($carac['modele']) ?> <a href="<?php echo base_url("parapentes/?immatriculation=").$carac['immatriculation'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['parapentes']['nbMoinsLoue'] ?> location<?php if ($infos['parapentes']['nbMoinsLoue'] > 1) echo 's' ?>)</em>
				<?php endif ?>
			</p>

			<!-- Parapente le plus fiable -->
			<?php if ($infos['parapentes']['plusFiableResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parapentes']['plusFiableResult']['data'][0];
				}
			?>
			<p>
				<strong>Le plus fiable : </strong><br/>
				<?php if ($carac == null) : ?>
					Aucun parapente enregistré
				<?php else : ?>
					<?php echo $carac['immatriculation'] ?> - <?php echo ucfirst($carac['marque']) ?> <?php echo ucfirst($carac['modele']) ?> <a href="<?php echo base_url("parapentes/?immatriculation=").$carac['immatriculation'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo round($infos['parapentes']['fiabilitePlusFiable'], 1) ?> % de contrôles OK)</em>
				<?php endif ?>
			</p>

			<!-- Parapente le moins fiable -->
			<?php if ($infos['parapentes']['moinsFiableResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parapentes']['moinsFiableResult']['data'][0];
				}
			?>
			<p>
				<strong>Le moins fiable : </strong><br/>
				<?php if ($carac == null) : ?>
					Aucun parapente enregistré
				<?php else : ?>
					<?php echo $carac['immatriculation'] ?> - <?php echo ucfirst($carac['marque']) ?> <?php echo ucfirst($carac['modele']) ?> <a href="<?php echo base_url("parapentes/?immatriculation=").$carac['immatriculation'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo round($infos['parapentes']['fiabiliteMoinsFiable'], 1) ?> % de contrôles OK)</em>
				<?php endif ?>
			</p>

			<!-- Parapente le plus souvent endommagé -->
			<?php if ($infos['parapentes']['nulResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parapentes']['nulResult']['data'][0];
				}
			?>
			<p>
				<strong>Le plus souvent endommagé : </strong><br/>
				<?php if ($carac == null) : ?>
					Aucun parapente enregistré
				<?php else : ?>
					<?php echo $carac['immatriculation'] ?> - <?php echo ucfirst($carac['marque']) ?> <?php echo ucfirst($carac['modele']) ?> <a href="<?php echo base_url("parapentes/?immatriculation=").$carac['immatriculation'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['parapentes']['nulPannes'] ?> fois)</em>
				<?php endif ?>
			</p>
		</div>
	</div>
</div>

<div class="col-md-5">

	<!-- Clients -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="glyphicon glyphicon-user"></span> Clients</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo $infos['clients']['total'] ?> <em>(<?php echo $infos['clients']['totalPilotes'].' pilote'; if ($infos['clients']['totalPilotes'] > 1) echo 's' ?> et <?php echo $infos['clients']['totalInvites'].' invité'; if ($infos['clients']['totalInvites'] > 1) echo 's' ?>)</em>
			</p>
			<p>
				<strong>Locations moyennes par pilote : </strong>
				<?php echo $infos['clients']['locations_moyennes'] ?>
			</p>
			<p>
				<strong>CA moyen par pilote : </strong>
				<?php echo round($infos['clients']['CA_moyen'], 2) ?> €
			</p>
			
			<?php if ($infos['clients']['meilleurResult'] == null) {
					$caracMeilleur = null;
				} else {
					$caracMeilleur = $infos['clients']['meilleurResult']['data'][0];
				}
			?>
			<p>
				<strong>Meilleur pilote : </strong>
				<?php if ($caracMeilleur == null) : ?>
					Aucun pilote enregistré
				<?php else : ?>
					<?php echo ucfirst($caracMeilleur['prenom']).' '.strtoupper($caracMeilleur['nom']) ?> <a href="<?php echo base_url("pilotes/?id=").$caracMeilleur['id'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['clients']['meilleurCA'] ?> €)</em>
				<?php endif ?>
			</p>
		</div>
	</div>

	<!-- Contrôles techniques -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="glyphicon glyphicon-check"></span> Contrôles techniques</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo $infos['controles']['total'] ?> <em>(<?php echo $infos['controles']['totalPonctuels'].' ponctuel'; if ($infos['controles']['totalPonctuels'] > 1) echo 's' ?> et <?php echo $infos['controles']['totalRecurrents'].' récurrent'; if ($infos['controles']['totalRecurrents'] > 1) echo 's' ?>)</em>
			</p>
			<p>
				<strong>Contrôles OK : </strong>
				<?php echo round($infos['controles']['prcentOK'], 1); if ($infos['controles']['prcentOK'] > 0) echo ' %' ?>
			</p>
		</div>
	</div>

	<!-- Parcours -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="fa fa-map"></span> Parcours</span>
		</div>
		<div class="panel-body">
			<p>
				<strong>Total : </strong>
				<?php echo $infos['parcours']['total'] ?>
			</p>

			<!-- Parcours le plus utilisé -->
			<?php if ($infos['parcours']['plusUtiliseResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parcours']['plusUtiliseResult']['data'][0];
				}
			?>
			<p>
				<strong>Le plus utilisé : </strong>
				<?php if ($carac == null) : ?>
					Aucun parcours enregistré
				<?php else : ?>
					<?php echo ucfirst($carac['nom']) ?> <a href="<?php echo base_url("parcours/?id=").$carac['id'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['parcours']['nbPlusUtilise'] ?> fois)</em>
				<?php endif ?>
			</p>

			<!-- Parcours le moins utilisé -->
			<?php if ($infos['parcours']['moinsUtiliseResult'] == null) {
					$carac = null;
				} else {
					$carac = $infos['parcours']['moinsUtiliseResult']['data'][0];
				}
			?>
			<p>
				<strong>Le moins utilisé : </strong>
				<?php if ($carac == null) : ?>
					Aucun parcours enregistré
				<?php else : ?>
					<?php echo ucfirst($carac['nom']) ?> <a href="<?php echo base_url("parcours/?id=").$carac['id'] ?>"><?php echo $this->config->item('icons')['external_link'] ?></a> <em>(<?php echo $infos['parcours']['nbMoinsUtilise'] ?> fois)</em>
				<?php endif ?>
			</p>
		</div>
	</div>

	<!-- Préférences -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title clearfix large"><span class="fa fa-cog"></span> Préférences</strong></span>
		</div>
		<div class="panel-body form-horizontal">
			<form id="form_preferences" class="col-lg-12" action='<?php echo base_url() ?>' method="POST">
			  <fieldset>
				<div class="form-group col-lg-12">
				 <label class="col-md-5 control-label" for="tarif_defaut">Tarif par défaut</label>
				 <div class="col-md-7">
				 	<select id="tarif_defaut" name="tarif_defaut" class="form-control">
				 		<?php 
				 			foreach ($tarifs as $num_tarif => $tarif) : ?>
				 				<option value="<?php echo $tarif['id'] ?>"><?php echo $tarif['libelle'].' : '.$tarif['coefficient'].' € / mn' ?></option>
				 			<?php endforeach; ?>
				 	</select>
				 	<button style="margin-top: 5px" type="button" class="btn btn-success" href="#modal_tarif_creer" data-toggle="modal"><span class="fa fa-plus"></span> Nouveau</button>
				 </div>
				</div>

				<!--<div class="form-group">
				  <label class="col-md-4 control-label" for="submit"></label>
				    <button type="submit" class="btn btn-primary">Enregistrer</button>
				</div>-->
			  </fieldset>
			</form>
		</div>
	</div>
</div>