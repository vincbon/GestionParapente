<?php
class Locations extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Location_model');
		$this->load->model('Pilote_model');
		$this->load->model('Parapente_model');
		$this->load->model('Invite_model');
		$this->load->model('Parcours_model');
		$this->load->model('ControleRecurrent_model');
	}

	public function get_tarifs() {
		return $this->Tarif_model->get()->result_array();
	}

	public function get_dependences_data() {
		$data['pilotes']['data'] = $this->Pilote_model->get()->result_array();
		$data['pilotes']['metadata'] = $this->Pilote_model->getFieldsMetaData();
		$data['pilotes']['headings'] = $this->perso->get_headings('pilote');
		$data['pilotes']['misc'] = $this->Pilote_model->getMisc();
		$this->perso->set_data_for_display('pilote', $data['pilotes']['data']);
		$data['parapentes']['data'] = $this->Parapente_model->get()->result_array();
		$data['parapentes']['metadata'] = $this->Parapente_model->getFieldsMetaData();
		$data['parapentes']['headings'] = $this->perso->get_headings('parapente');
		$data['parapentes']['misc'] = $this->Parapente_model->getMisc();
		$this->perso->set_data_for_display('parapente', $data['parapentes']['data']);
		$data['parcours']['data'] = $this->Parcours_model->get()->result_array();
		$data['parcours']['metadata'] = $this->Parcours_model->getFieldsMetaData();
		$data['parcours']['headings'] = $this->perso->get_headings('parcours');
		$data['parcours']['misc'] = $this->Parcours_model->getMisc();
		//$this->perso->set_data_for_display('parcours', $data['parcours']['data']);
		$data['invites']['data'] = $this->Invite_model->get()->result_array();
		$data['invites']['metadata'] = $this->Invite_model->getFieldsMetaData();
		$data['invites']['headings'] = $this->perso->get_headings('invite');
		$data['invites']['misc'] = $this->Invite_model->getMisc();
		$this->perso->set_data_for_display('invite', $data['invites']['data']);

		return $data;
	}

	public function index() {
		$data['title'] = 'Gestion des locations';
		$this->load->view('header', $data);

		// Critères sur les locations à afficher
		$champs = $this->Location_model->getFields();
		$data['champsLike'] = null;
		$data['champsEqual'] = null;
		foreach ($champs as $champ) {
			if (isset($_GET[$champ])) {
				if (($champ == 'id')
				OR ($champ == 'pilote')
				OR ($champ == 'invite')
				OR ($champ == 'parcours')
				OR ($_GET[$champ] == 'true' OR $_GET[$champ] == 'false')
				OR strtotime(str_replace('/', '-', $_GET[$champ]))) {
					$data['champsEqual'][$champ] = $_GET[$champ];
				} else {
					$data['champsLike'][$champ] = $_GET[$champ];
				}
				$data['old_data'][$champ] = $_GET[$champ];
			}
		}

		$data = array_merge($data, $this->get_dependences_data());
		$this->load->view('formRechercheLocation', $data);

		$this->display_locations($data);

		$this->load->view('footer', $data);
	}

	public function display_locations($data) {
		$data['title'] = 'Locations';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}
		
		// Récupération des données
		$data['array_data'] = $this->Location_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$data['fields_metadata'] = $this->Location_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('location');
		$data['miscInfos'] = $this->Location_model->getMisc();

		$this->perso->set_data_for_display('location', $data['array_data']);

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnInfos'] = false;
		$data['btnSelect'] = false;

		$data['object'] = 'location';

		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter une location';

		if (isset($_POST['date'])) {
			$_POST['duree'] = $_POST['duree_h'] + (int)($_POST['duree_mn'])*60;
			unset($_POST['duree_h']);
			unset($_POST['duree_mn']);
			unset($_POST['tarif']);
			try {
				$this->Location_model->add($_POST);
				redirect('/locations', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/locations', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'ajouter/';
			$data['tarifs'] = $this->get_tarifs();
			$data = array_merge($data, $this->get_dependences_data());
			
			$this->load->view('formLocation', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier une location';

		if (isset($_POST['date'])) {
			try {
				$this->Location_model->update($id, $_POST);
				redirect('/locations', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/locations', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'modifier/'.$id;
			$data['tarifs'] = $this->get_tarifs();
			$data['old_data'] = $this->Location_model->get('id', array('id' => $id), null)->result_array()[0];
			$data = array_merge($data, $this->get_dependences_data());
			$this->load->view('formLocation', $data);

			$this->load->view('footer', $data);
		}
	}
}