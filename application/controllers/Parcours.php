<?php
class Parcours extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Parcours_model');
	}

	public function index() {
		$data['title'] = 'Gestion des parcours';
		$this->load->view('header', $data);

		// Critères sur les parcours à afficher
		$champs = $this->Parcours_model->getFields();
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
		
		$this->load->view('formRechercheParcours', $data);

		$this->display_parcours($data);

		$this->load->view('footer', $data);
	}

	public function display_parcours($data) {
		$data['title'] = 'Parcours';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}
		
		// Récupération des données
		$data['array_data'] = $this->Parcours_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$data['fields_metadata'] = $this->Parcours_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('parcours');
		$data['miscInfos'] = $this->Parcours_model->getMisc();
		
		// Traitement des lignes
		/*foreach($data['array_data'] as $num_row => $row) {
		}*/

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnInfos'] = true;

		$miscInfos_ = $this->Parcours_model->getMisc();
		
		$data['miscInfos'] = $miscInfos_;

		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un parcours';

		if (isset($_POST['nom'])) {
			try {
				$this->Parcours_model->add($_POST);
				redirect('/parcours', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/parcours', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'ajouter';
			$this->load->view('formParcours', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier un parcours';

		if (isset($_POST['nom'])) {
			try {
				$this->Parcours_model->update($id, $_POST);
				redirect('/parcours', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/parcours', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'modifier/'.$id;
			$data['old_data'] = $this->Parcours_model->get('id', array('id' => $id), null)->result_array()[0];
			$this->load->view('formParcours', $data);

			$this->load->view('footer', $data);
		}
	}
}