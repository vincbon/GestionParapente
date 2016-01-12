<?php
class ControlesPonctuels extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ControlePonctuel_model');
		$this->load->model('Parapente_model');
	}

	public function index() {
		$data['title'] = 'Gestion des contrôles ponctuels';
		$this->load->view('header', $data);

		// Critères sur les contrôles ponctuels à afficher
		$champs = $this->ControlePonctuel_model->getFields();
		$data['champsLike'] = null;
		$data['champsEqual'] = null;
		foreach ($champs as $champ) {
			if (isset($_GET[$champ])) {
				if (($champ == 'id')
				OR ($_GET[$champ] == 'true' OR $_GET[$champ] == 'false')
				OR strtotime(str_replace('/', '-', $_GET[$champ]))) {
					$data['champsEqual'][$champ] = $_GET[$champ];
				} else {
					$data['champsLike'][$champ] = $_GET[$champ];
				}
				$data['old_data'][$champ] = $_GET[$champ];
			}
		}
		
		$data['parapentes']['data'] = $this->Parapente_model->get()->result_array();
		$data['parapentes']['metadata'] = $this->Parapente_model->getFieldsMetaData();
		$data['parapentes']['headings'] = $this->perso->get_headings('parapente');
		$data['parapentes']['misc'] = $this->Parapente_model->getMisc();
		$this->load->view('formRechercheControlePonctuel', $data);

		$this->display_controles_ponctuels($data);

		$this->load->view('footer', $data);
	}

	public function display_controles_ponctuels($data) {
		$data['title'] = 'Contrôles ponctuels';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}
		
		// Récupération des données
		$data['array_data'] = $this->ControlePonctuel_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$this->perso->set_data_for_display('controle_ponctuel', $data['array_data']);
		$data['fields_metadata'] = $this->ControlePonctuel_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('controle_ponctuel');

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnSelect'] = false;
		$data['btnInfos'] = false;

		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un contrôle ponctuel';

		if (isset($_POST['date'])) {
			if (!isset($_POST['voile'])) $_POST['voile'] = false;
			if (!isset($_POST['suspentes'])) $_POST['suspentes'] = false;
			if (!isset($_POST['freins'])) $_POST['freins'] = false;
			if (!isset($_POST['sellette'])) $_POST['sellette'] = false;
			if (!isset($_POST['accelerateur'])) $_POST['accelerateur'] = false;
			if (!isset($_POST['trim'])) $_POST['trim'] = false;
			if (!isset($_POST['casque'])) $_POST['casque'] = false;

			try {
				$this->ControlePonctuel_model->add($_POST);
				redirect('/controlesponctuels', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/controlesponctuels', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['parapentes']['data'] = $this->Parapente_model->get()->result_array();
			$data['parapentes']['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$data['parapentes']['headings'] = $this->perso->get_headings('parapente');
			$data['parapentes']['misc'] = $this->Parapente_model->getMisc();
			
			$data['function'] = 'ajouter';
			$this->load->view('formControlePonctuel', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier un contrôle ponctuel';

		if (isset($_POST['date'])) {
			if (!isset($_POST['voile'])) $_POST['voile'] = false;
			if (!isset($_POST['suspentes'])) $_POST['suspentes'] = false;
			if (!isset($_POST['freins'])) $_POST['freins'] = false;
			if (!isset($_POST['sellette'])) $_POST['sellette'] = false;
			if (!isset($_POST['accelerateur'])) $_POST['accelerateur'] = false;
			if (!isset($_POST['trim'])) $_POST['trim'] = false;
			if (!isset($_POST['casque'])) $_POST['casque'] = false;

			try {
				$this->ControlePonctuel_model->update($id, $_POST);
				redirect('/controlesponctuels', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/controlesponctuels', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['parapentes']['data'] = $this->Parapente_model->get()->result_array();
			$data['parapentes']['metadata'] = $this->Parapente_model->getFieldsMetaData();
			$data['parapentes']['headings'] = $this->perso->get_headings('parapente');
			$data['parapentes']['misc'] = $this->Parapente_model->getMisc();
			
			$data['function'] = 'modifier/'.$id;
			$data['old_data'] = $this->ControlePonctuel_model->get('id', array('id' => $id), null)->result_array()[0];
			$this->load->view('formControlePonctuel', $data);

			$this->load->view('footer', $data);
		}
	}
}