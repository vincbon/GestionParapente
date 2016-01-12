<?php
class Pilotes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pilote_model');
	}

	public function index() {
		$data['title'] = 'Gestion des pilotes';
		$this->load->view('header', $data);

		// Critères sur les pilotes à afficher
		$champs = $this->Pilote_model->getFields();
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
		
		$this->load->view('formRecherchePilote', $data);

		$this->display_pilotes($data);

		$this->load->view('footer', $data);
	}

	public function display_pilotes($data) {
		$data['title'] = 'Pilotes';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}

		// Récupération des données
		$data['array_data'] = $this->Pilote_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$data['fields_metadata'] = $this->Pilote_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('pilote');
		$data['miscInfos'] = $this->Pilote_model->getMisc();

		$this->perso->set_data_for_display('pilote', $data['array_data']);

		// Traitement des lignes
		/*foreach($data['array_data'] as $num_row => $row) {
		}*/

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnInfos'] = true;
		$data['object'] = 'pilote';
		$data['miscInfos'] = $this->Pilote_model->getMisc();

		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un pilote';

		if (isset($_POST['nom'])) {
			if (!isset($_POST['qualification_biplace'])) {
				$_POST['qualification_biplace'] = false;
			}
			$_POST['nom'] = strtolower($_POST['nom']);
			$_POST['prenom'] = strtolower($_POST['prenom']);
			try {
				$this->Pilote_model->add($_POST);
				redirect('/pilotes', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/pilotes', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'ajouter';
			$this->load->view('formPilote', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier un pilote';

		if (isset($_POST['nom'])) {
			if (!isset($_POST['qualification_biplace'])) {
				$_POST['qualification_biplace'] = false;
			}
			$_POST['nom'] = strtolower($_POST['nom']);
			$_POST['prenom'] = strtolower($_POST['prenom']);
			try {
				$this->Pilote_model->update($id, $_POST);
				redirect('/pilotes', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/pilotes', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'modifier/'.$id;
			$data['old_data'] = $this->Pilote_model->get('id', array('id' => $id), null)->result_array()[0];
			$this->load->view('formPilote', $data);

			$this->load->view('footer', $data);
		}
	}
}