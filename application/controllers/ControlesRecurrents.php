<?php
class ControlesRecurrents extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ControleRecurrent_model');
		$this->load->model('Location_model');
	}

	public function index() {
		$data['title'] = 'Gestion des contrôles récurrents';
		$this->load->view('header', $data);

		// Critères sur les contrôles récurrents à afficher
		$champs = $this->ControleRecurrent_model->getFields();
		$data['champsLike'] = null;
		$data['champsEqual'] = null;
		foreach ($champs as $champ) {
			if (isset($_GET[$champ])) {
				if (($champ == 'id')
				OR ($champ == 'location')
				OR ($_GET[$champ] == 'true' OR $_GET[$champ] == 'false')
				OR strtotime(str_replace('/', '-', $_GET[$champ]))) {
					$data['champsEqual'][$champ] = $_GET[$champ];
				} else {
					$data['champsLike'][$champ] = $_GET[$champ];
				}
				$data['old_data'][$champ] = $_GET[$champ];
			}
		}
		
		$data['locations']['data'] = $this->Location_model->get()->result_array();
		$this->perso->set_data_for_display('location', $data['locations']['data']);
		$data['locations']['metadata'] = $this->Location_model->getFieldsMetaData();
		$data['locations']['headings'] = $this->perso->get_headings('location');
		$data['locations']['misc'] = $this->Location_model->getMisc();
		$this->load->view('formRechercheControleRecurrent', $data);

		$this->display_controles_recurrents($data);

		$this->load->view('footer', $data);
	}

	public function display_controles_recurrents($data) {
		$data['title'] = 'Contrôles récurrents';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}
		
		// Récupération des données
		$data['array_data'] = $this->ControleRecurrent_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$this->perso->set_data_for_display('controle_recurrent', $data['array_data']);
		$data['fields_metadata'] = $this->ControleRecurrent_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('controle_recurrent');

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnSelect'] = false;
		$data['btnInfos'] = false;
		
		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un contrôle récurrent';

		if (isset($_POST['location'])) {
			if (!isset($_POST['voile'])) $_POST['voile'] = false;
			if (!isset($_POST['suspentes'])) $_POST['suspentes'] = false;
			if (!isset($_POST['freins'])) $_POST['freins'] = false;
			if (!isset($_POST['sellette'])) $_POST['sellette'] = false;
			if (!isset($_POST['accelerateur'])) $_POST['accelerateur'] = false;
			if (!isset($_POST['trim'])) $_POST['trim'] = false;
			if (!isset($_POST['casque'])) $_POST['casque'] = false;

			try {
				$this->ControleRecurrent_model->add($_POST);
				redirect('/controlesrecurrents', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/controlesrecurrents', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['locations']['data'] = $this->Location_model->get('id', array('controle_apres' => null))->result_array();
			$this->perso->set_data_for_display('location', $data['locations']['data']);
			$data['locations']['metadata'] = $this->Location_model->getFieldsMetaData();
			$data['locations']['headings'] = $this->perso->get_headings('location');
			$data['locations']['misc'] = $this->Location_model->getMisc();
			
			$data['function'] = 'ajouter';
			$this->load->view('formControleRecurrent', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier un contrôle récurrent';

		if (isset($_POST['date'])) {
			if (!isset($_POST['voile'])) $_POST['voile'] = false;
			if (!isset($_POST['suspentes'])) $_POST['suspentes'] = false;
			if (!isset($_POST['freins'])) $_POST['freins'] = false;
			if (!isset($_POST['sellette'])) $_POST['sellette'] = false;
			if (!isset($_POST['accelerateur'])) $_POST['accelerateur'] = false;
			if (!isset($_POST['trim'])) $_POST['trim'] = false;
			if (!isset($_POST['casque'])) $_POST['casque'] = false;

			try {
				$this->ControleRecurrent_model->update($id, $_POST);
				redirect('/controlesrecurrents', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/controlesrecurrents', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['locations']['data'] = $this->Location_model->get()->result_array();
			$data['locations']['metadata'] = $this->Location_model->getFieldsMetaData();
			$data['locations']['headings'] = $this->perso->get_headings('location');
			$data['locations']['misc'] = $this->Location_model->getMisc();
			
			$data['function'] = 'modifier/'.$id;
			$data['old_data'] = $this->ControleRecurrent_model->get('id', array('id' => $id), null)->result_array()[0];
			$this->load->view('formControleRecurrent', $data);

			$this->load->view('footer', $data);
		}
	}
}