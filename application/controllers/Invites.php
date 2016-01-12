<?php
class Invites extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Invite_model');
	}

	public function index() {
		$data['title'] = 'Gestion des invités';
		$this->load->view('header', $data);

		// Critères sur les invites à afficher
		$champs = $this->Invite_model->getFields();
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
		
		$this->load->view('formRechercheInvite', $data);

		$this->display_invites($data);

		$this->load->view('footer', $data);
	}

	public function display_invites($data) {
		$data['title'] = 'Invités';
		
		// Critère de tri
		if (isset($_GET['o'])) {
			$o = $_GET['o'];
		} else {
			$o = 'id';
		}
		
		// Récupération des données
		$data['array_data'] = $this->Invite_model->get($o, $data['champsEqual'], $data['champsLike'])->result_array();
		$data['fields_metadata'] = $this->Invite_model->getFieldsMetaData();
		$data['array_headings'] = $this->perso->get_headings('invite');
		$data['miscInfos'] = $this->Invite_model->getMisc();
		
		$this->perso->set_data_for_display('invite', $data['array_data']);

		// Traitement des lignes
		/*foreach($data['array_data'] as $num_row => $row) {
		}*/

		$data['btnNouveau'] = true;
		$data['btnModif'] = true;
		$data['btnInfos'] = true;
		$data['miscInfos'] = $this->Invite_model->getMisc();

		$this->load->view('table', $data);
	}

	public function ajouter() {
		$data['title'] = 'Ajouter un invité';

		if (isset($_POST['nom'])) {
			try {
				$this->Invite_model->add($_POST);
				redirect('/invites', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/invites', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'ajouter';
			$this->load->view('formInvite', $data);

			$this->load->view('footer', $data);
		}
	}

	public function modifier($id) {
		$data['title'] = 'Modifier un invité';

		if (isset($_POST['nom'])) {
			try {
				$this->Invite_model->update($id, $_POST);
				redirect('/invites', 'location', 301);
			} catch (Exception $e) {
				$data['error_message'] = $e.getMessage();
				redirect('/invites', 'location', 400);
			}
		} else {
			$this->load->view('header', $data);

			$data['function'] = 'modifier/'.$id;
			$data['old_data'] = $this->Invite_model->get('id', array('id' => $id), null)->result_array()[0];
			$this->load->view('formInvite', $data);

			$this->load->view('footer', $data);
		}
	}
}