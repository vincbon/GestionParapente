<?php
class Parapentes extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Parapente_model');
	}

	public function index() {
		$data['title'] = 'Gestion des parapentes';
		$this->load->view('header', $data);

		// Critères sur les parapentes à afficher
		$champs = $this->Parapente_model->getFields();
		$data['champsLike'] = null;
		$data['champsEqual'] = null;
		foreach ($champs as $champ) {
			if (isset($_GET[$champ])) {
				if (($champ == 'immatriculation')
				OR ($_GET[$champ] == 'true' OR $_GET[$champ] == 'false')
				OR strtotime(str_replace('/', '-', $_GET[$champ]))) {
					$data['champsEqual'][$champ] = $_GET[$champ];
				} else {
					$data['champsLike'][$champ] = $_GET[$champ];
				}
				$data['old_data'][$champ] = $_GET[$champ];
			}
		}
		
		$this->load->view('formRechercheParapente', $data);

		$this->display_parapentes($data);

		$this->load->view('footer', $data);
	}

	public function display_parapentes($data) {
		$data['title'] = 'Parapentes';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'immatriculation';
		}
		
		// Récupération des données
		$data['array_data'] = $this->Parapente_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$data['fields_metadata'] = $this->Parapente_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('parapente');
		$data['miscInfos'] = $this->Parapente_model->getMisc();
		
		// Traitement des lignes
		/*foreach($data['array_data'] as $num_row => $row) {
		}*/

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnInfos'] = true;
		$data['object'] = 'parapente';
		$data['show_false'] = array('en_etat_de_voler');
		
		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un parapente';

		if (isset($_POST['immatriculation'])) {
			if (!isset($_POST['biplace'])) {
				$_POST['biplace'] = false;
			}
			$_POST['ptv'] = '['.$_POST['ptv'].','.$_POST['ptv_tmp'].']';
			unset($_POST['ptv_tmp']);
			try {
				$this->Parapente_model->add($_POST);
				redirect('/parapentes', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/parapentes', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'ajouter';
			$this->load->view('formParapente', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($immatriculation) {
		$data['title'] = 'Modifier un parapente';

		if (isset($_POST['immatriculation'])) {
			if (!isset($_POST['biplace'])) {
				$_POST['biplace'] = false;
			}
			$_POST['ptv'] = '['.$_POST['ptv'].','.$_POST['ptv_tmp'].']';
			unset($_POST['ptv_tmp']);
			try {
				$this->Parapente_model->update($immatriculation, $_POST);
				redirect('/parapentes', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/parapentes', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'modifier/'.$immatriculation;
			$data['old_data'] = $this->Parapente_model->get('immatriculation', array('immatriculation' => $immatriculation), null)->result_array()[0];
			$this->load->view('formParapente', $data);

			$this->load->view('footer', $data);
		}
	}
}