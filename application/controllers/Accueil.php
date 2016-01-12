<?php
class Accueil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Location_model');
		$this->load->model('Pilote_model');
		$this->load->model('Invite_model');
		$this->load->model('Parapente_model');
		$this->load->model('ControlePonctuel_model');
		$this->load->model('ControleRecurrent_model');
		$this->load->model('Parcours_model');
	}
	
	public function index() {
		if (!empty($_POST['libelle'])) {
			unset($_POST['tarif_defaut']);
			$this->Tarif_model->add($_POST);
			redirect('/');
		} else if (isset($_POST['tarif_defaut'])) {
			$old_default = $this->Tarif_model->getDefault()['id'];
			if ($old_default != $_POST['tarif_defaut']) {
				$this->Tarif_model->update($old_default, array('defaut' => false));
				$this->Tarif_model->update($_POST['tarif_defaut'], array('defaut' => true));
			}
			redirect('/');
		}

		$data['tarifs'] = $this->Tarif_model->get()->result_array();

		$data['title'] = 'Tableau de bord';
		$this->load->view('header', $data);

		// Informations sur le chiffre d'affaires
		$data['infos']['chiffre'] = array(
			'total' => $this->Location_model->caTotal(),
			'CA_moyen_mois' => $this->Location_model->caMoyenParMois(),
			'CA_30_jours' => $this->Location_model->caDernierMois(),
		);

		// Informations sur les locations
		$data['infos']['locations'] = array(
			'total' => $this->Location_model->count(),
			'parMois' => $this->Location_model->nbParMois(),
			'CA_moyen_location' => $this->Location_model->caMoyenParLocation(),
		);

		// Informations sur les clients
		$nbPilotes = $this->Pilote_model->count();
		$nbInvites = $this->Invite_model->count();
		$meilleur = $this->Pilote_model->meilleur();
		if ($meilleur['id'] == null) {
			$meilleurResult = null;
		} else {
			$meilleurResult['data'] = $this->Pilote_model->get('id', array('id' => $meilleur['id']), null)->result_array();
			$meilleurResult['metadata'] = $this->Pilote_model->getFieldsMetaData();
			$meilleurResult['misc'] = $this->Pilote_model->getMisc();
			$meilleurResult['headings'] = $this->perso->get_headings('pilote');
		}
		$data['infos']['clients'] = array(
			'total' => $nbPilotes + $nbInvites,
			'totalPilotes' => $nbPilotes,
			'totalInvites' => $nbInvites,
			'locations_moyennes' => $this->Pilote_model->locationsMoyennes(),
			'CA_moyen' => $this->Pilote_model->caMoyen(),
			'meilleurCA' => $meilleur['CA'],
			'meilleurResult' => $meilleurResult,
		);

		// Informations sur les parapentes
		$lesParapentes = $this->Parapente_model->get('immatriculation', null, null)->result_array();
		$paraEtLocations= null;
		foreach ($lesParapentes as $parapente) {
			$paraEtLocations[$parapente['immatriculation']] = $this->Location_model->get('id', array('parapente' => $parapente['immatriculation']))->result_array();
		}
		$nul = $this->Parapente_model->nul();
		$bon = $this->Parapente_model->souventLoue(true);
		$moinsBon = $this->Parapente_model->souventLoue(false);
		$plusFiable = $this->Parapente_model->fiable($paraEtLocations, true);
		$moinsFiable = $this->Parapente_model->fiable($paraEtLocations, false);
		if ($bon['immatriculation'] == null) {
			$nulResult = null;
			$bonResult = null;
			$moinsBonResult = null;
			$plusFiableResult = null;
			$moinsFiableResult = null;
		} else {
			$nulResult['data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $nul['immatriculation']), null)->result_array();
			$nulResult['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$nulResult['misc'] = $this->Parapente_model->getMisc();
			$nulResult['headings'] = $this->perso->get_headings('parapente');
			$bonResult['data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $bon['immatriculation']), null)->result_array();
			$bonResult['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$bonResult['misc'] = $this->Parapente_model->getMisc();
			$bonResult['headings'] = $this->perso->get_headings('parapente');
			$moinsBonResult['data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $moinsBon['immatriculation']), null)->result_array();
			$moinsBonResult['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$moinsBonResult['misc'] = $this->Parapente_model->getMisc();
			$moinsBonResult['headings'] = $this->perso->get_headings('parapente');
			$plusFiableResult['data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $plusFiable['immatriculation']), null)->result_array();
			$plusFiableResult['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$plusFiableResult['misc'] = $this->Parapente_model->getMisc();
			$plusFiableResult['headings'] = $this->perso->get_headings('parapente');
			$moinsFiableResult['data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $moinsFiable['immatriculation']), null)->result_array();
			$moinsFiableResult['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$moinsFiableResult['misc'] = $this->Parapente_model->getMisc();
			$moinsFiableResult['headings'] = $this->perso->get_headings('parapente');
		}
		$data['infos']['parapentes'] = array(
			'total' => $this->Parapente_model->count(),
			'nulPannes' => $nul['pannes'],
			'nulResult' => $nulResult,
			'nbPlusLoue' => $bon['nbLoue'],
			'plusLoueResult' => $bonResult,
			'nbMoinsLoue' => $moinsBon['nbLoue'],
			'moinsLoueResult' => $moinsBonResult,
			'fiabilitePlusFiable' => $plusFiable['fiabilite'],
			'plusFiableResult' => $plusFiableResult,
			'fiabiliteMoinsFiable' => $moinsFiable['fiabilite'],
			'moinsFiableResult' => $moinsFiableResult,
		);

		// Informations sur les contrôles techniques
		$nbPonctuels = $this->ControlePonctuel_model->count();
		$nbRecurrents = $this->ControleRecurrent_model->count();
		$nbTotal = $nbPonctuels + $nbRecurrents;
		$nbOKPonctuels = $this->ControlePonctuel_model->countOK();
		$nbOKRecurrents = $this->ControleRecurrent_model->countOK();
		if ($nbTotal == 0) {
			$prcentOK = 'aucun';
		} else {
			$prcentOK = (($nbOKPonctuels + $nbOKRecurrents) / ($nbTotal)) * 100;
		}
		$data['infos']['controles'] = array(
			'total' => $nbTotal,
			'totalPonctuels' => $nbPonctuels,
			'totalRecurrents' => $nbRecurrents,
			'prcentOK' => $prcentOK,
		);

		// Informations sur les parcours
		$plusUtilise = $this->Parcours_model->utilise(true);
		$moinsUtilise = $this->Parcours_model->utilise(false);
		if ($plusUtilise['id'] == null) {
			$plusUtiliseResult = null;
			$moinsUtiliseResult = null;
		} else {
			$plusUtiliseResult['data'] = $this->Parcours_model->get('id', array('id' => $plusUtilise['id']), null)->result_array();
			$plusUtiliseResult['metadata'] = $this->Parcours_model->getFieldsMetaData();
			$plusUtiliseResult['misc'] = $this->Parcours_model->getMisc();
			$plusUtiliseResult['headings'] = $this->perso->get_headings('parcours');
			$moinsUtiliseResult['data'] = $this->Parcours_model->get('id', array('id' => $moinsUtilise['id']), null)->result_array();
			$moinsUtiliseResult['metadata'] = $this->Parcours_model->getFieldsMetaData();
			$moinsUtiliseResult['misc'] = $this->Parcours_model->getMisc();
			$moinsUtiliseResult['headings'] = $this->perso->get_headings('parcours');
		}
		$data['infos']['parcours'] = array(
			'total' => $this->Parcours_model->count(),
			'nbPlusUtilise' => $plusUtilise['nbUtilise'],
			'plusUtiliseResult' => $plusUtiliseResult,
			'nbMoinsUtilise' => $moinsUtilise['nbUtilise'],
			'moinsUtiliseResult' => $moinsUtiliseResult,
		);
		
		$this->load->view('index', $data);
		$this->load->view('footer', $data);
	}
}