<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perso {

	public function __construct() {
    	$this->CI =& get_instance();
    	$this->CI->load->model('Pilote_model');
    	$this->CI->load->model('Invite_model');
    	$this->CI->load->model('Parapente_model');
    	$this->CI->load->model('Location_model');
    	$this->CI->load->model('Parcours_model');
    	$this->CI->load->model('ControlePonctuel_model');
    	$this->CI->load->model('ControleRecurrent_model');
	}

    public function get_headings($object) {
    	$headings = array(
    		'location' => array(
				'id' => 'ID',
				'pilote' => 'Pilote',
				'parapente' => 'Parapente',
				'invite' => 'Invité',
				'parcours' => 'Parcours',
				'date' => 'Date',
				'duree' => 'Durée (mn)',
				'prix' => 'Prix (€)',
				'controle_avant' => 'Contrôle avant',
				'controle_apres' => 'Contrôle après'
			),
    		'pilote' => array(
				'id' => 'ID',
				'nom' => 'Nom',
				'prenom' => 'Prénom',
				'no_licence' => 'N° Licence',
				'niveau' => 'Niveau',
				'qualification_biplace' => 'Qualifié biplace',
				'date_de_naissance' => 'Date de naissance',
				'taille' => 'Taille (cm)',
				'poids' => 'Poids (kg)',
				'adresse' => 'Adresse',
				'ville' => 'Ville',
				'code_postal' => 'Code postal',
				'telephone' => 'Téléphone'
			),
			'invite' => array(
				'id' => 'ID',
				'nom' => 'Nom',
				'prenom' => 'Prénom',
				'date_de_naissance' => 'Date de naissance',
				'taille' => 'Taille (cm)',
				'poids' => 'Poids (kg)',
				'adresse' => 'Adresse',
				'ville' => 'Ville',
				'code_postal' => 'Code postal',
				'telephone' => 'Téléphone'
			),
			'parapente' => array(
				'immatriculation' => 'Immatriculation',
				'marque' => 'Marque',
				'modele' => 'Modele',
				'taille' => 'Taille',
				'ptv' => 'PTV (kg)',
				'biplace' => 'Biplace',
				'en_etat_de_voler' => 'En état de voler'
			),
			'parcours' => array(
				'id' => 'ID',
				'nom' => 'Nom',
				'ville' => 'Ville',
				'site_decollage' => 'Site de décollage',
				'site_atterrissage' => 'Site d\'atterrissage',
				'commentaire' => 'Commentaire'
			),
			'controle_ponctuel' => array(
				'id' => 'ID',
				'parapente' => 'Parapente',
				'date' => 'Date',
				'resultat' => 'Résultat',
				'commentaire' => 'Commentaire',
				'voile' => 'Voile',
				'suspentes' => 'Suspentes',
				'freins' => 'Freins',
				'sellette' => 'Sellette',
				'accelerateur' => 'Accélérateur',
				'trim' => 'Trim',
				'casque' => 'casque'
			),
			'controle_recurrent' => array(
				'id' => 'ID',
				'location' => 'Location',
				'resultat' => 'Résultat',
				'commentaire' => 'Commentaire',
				'voile' => 'Voile',
				'suspentes' => 'Suspentes',
				'freins' => 'Freins',
				'sellette' => 'Sellette',
				'accelerateur' => 'Accélérateur',
				'trim' => 'Trim',
				'casque' => 'Casque'
			),
		);

		return $headings[$object];
    }

    function set_data_for_display($object, &$data) {
    	switch($object) {
    		case 'location' :
				foreach($data as $num_row => $row) {
					// Case pilote
					$pilote = $this->CI->Pilote_model->get('id', array('id'=>$row['pilote']))->result_array()[0];
					$data[$num_row]['pilote'] = ucfirst(strtolower($pilote['prenom'])).' '.strtoupper($pilote['nom']).' <a href="'.base_url("pilotes/?id=").$pilote['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
					
					// Case parapente
					$parapente = $this->CI->Parapente_model->get('immatriculation', array('immatriculation'=>$row['parapente']))->result_array()[0];
					$data[$num_row]['parapente'] = $parapente['immatriculation'].' <a href="'.base_url("parapentes/?immatriculation=").$parapente['immatriculation'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';

					// Case invite
					if ($row['invite'] != null) {
						$invite = $this->CI->Invite_model->get('id', array('id'=>$row['invite']))->result_array()[0];
						$data[$num_row]['invite'] = ucfirst(strtolower($invite['prenom'])).' '.strtoupper($invite['nom']).' <a href="'.base_url("invites/?id=").$invite['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
					}

					// Case parcours
					$parcours = $this->CI->Parcours_model->get('id', array('id'=>$row['parcours']))->result_array()[0];
					$data[$num_row]['parcours'] = $parcours['nom'].' <a href="'.base_url("parcours/?id=").$parcours['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';

					// Case controle avant
					if ($row['controle_avant'] != null) {
						$controle_avant = $this->CI->ControleRecurrent_model->get('id', array('id'=>$row['controle_avant']))->result_array()[0];
						if ($controle_avant['resultat'] == 't') {
							$data[$num_row]['controle_avant'] = $this->CI->config->item('bool_display')['true'];
						} else {
							$data[$num_row]['controle_avant'] = $this->CI->config->item('bool_display')['false'];
						}
						$data[$num_row]['controle_avant'] .=  ' <a href="'.base_url("controlesrecurrents/?id=").$controle_avant['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
					}

					// Case controle après
					if ($row['controle_apres'] != null) {
						$controle_apres = $this->CI->ControleRecurrent_model->get('id', array('id'=>$row['controle_apres']))->result_array()[0];
						if ($controle_apres['resultat'] == 't') {
							$data[$num_row]['controle_apres'] = $this->CI->config->item('bool_display')['true'];
						} else {
							$data[$num_row]['controle_apres'] = $this->CI->config->item('bool_display')['false'];
						}
						$data[$num_row]['controle_apres'] .=  ' <a href="'.base_url("controlesrecurrents/?id=").$controle_apres['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
					}
				}
			break;
			case 'pilote' :
				foreach($data as $num_row => $row) {
					// Case nom
					$data[$num_row]['nom'] = strtoupper($data[$num_row]['nom']);

					// Case prenom
					$data[$num_row]['prenom'] = ucfirst(strtolower($data[$num_row]['prenom']));

					// Case ville
					$data[$num_row]['ville'] = ucfirst(strtolower($data[$num_row]['ville']));
					
					// Case telephone
					$split_tel = str_split($row['telephone'], 2);
					$data[$num_row]['telephone'] = '';
					foreach ($split_tel as $part) {
						$data[$num_row]['telephone'] .= ' '.$part;
					}
					$data[$num_row]['telephone'] = trim($data[$num_row]['telephone']);
				}
			break;
			case 'invite' :
				foreach($data as $num_row => $row) {
					// Case nom
					$data[$num_row]['nom'] = strtoupper($data[$num_row]['nom']);

					// Case prenom
					$data[$num_row]['prenom'] = ucfirst(strtolower($data[$num_row]['prenom']));

					// Case ville
					$data[$num_row]['ville'] = ucfirst(strtolower($data[$num_row]['ville']));
					
					// Case telephone
					$split_tel = str_split($row['telephone'], 2);
					$data[$num_row]['telephone'] = '';
					foreach ($split_tel as $part) {
						$data[$num_row]['telephone'] .= ' '.$part;
					}
					$data[$num_row]['telephone'] = $data[$num_row]['telephone'];
				}
			break;
			case 'controle_ponctuel' :
				foreach($data as $num_row => $row) {
					// Case parapente
					$parapente = $this->CI->Parapente_model->get('immatriculation', array('immatriculation'=>$row['parapente']))->result_array()[0];
					$data[$num_row]['parapente'] = $parapente['immatriculation'].' <a href="'.base_url("parapentes/?immatriculation=").$parapente['immatriculation'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
				}
			break;
			case 'controle_recurrent' :
				foreach($data as $num_row => $row) {
					// Case location
					$location = $this->CI->Location_model->get('id', array('id'=>$row['location']))->result_array()[0];
					$data[$num_row]['location'] = $location['id'].' <a href="'.base_url("locations/?id=").$location['id'].'">'.$this->CI->config->item('icons')['external_link'].'</a>';
				}
			break;
    	}
    }
}

/* End of file Someclass.php */