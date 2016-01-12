<?php
class Parapente_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue Parapente
	public function getFields() {
		return $this->db->list_fields('parapente');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('parapente') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des parapentes répondant aux critères spécifiés.
	public function get($orderby = 'immatriculation', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('parapente');
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les parapentes.
	 * 		Infos : Nombre de vols : total et moyenne par mois.
	 *				Nombre de fois tombé en panne (contrôle négatif).
	 */
	public function getMisc() {
		$query_result = $this->get('immatriculation', null, null);
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $parapente) {
			$immatriculation = $parapente['immatriculation'];

			// Calcul du nombre de vols total
			$this->db->where('parapente', $immatriculation);
			$this->db->from('vol');
			$infos[$immatriculation]['locations'] = $this->db->count_all_results();

			/* Calcul du nombre moyen de vols par mois
			$res = pg_query_params("SELECT * FROM GSI.F_Parapente_GETMOIS($1)", array($immatriculation));
			$nb_mois = pg_fetch_result($res, 0, 0);
			if ($nb_mois == 0) {
				$infos[$immatriculation]['vols_par_mois'] = $infos[$immatriculation]['vols'];
			} else {
				$infos[$immatriculation]['vols_par_mois'] = round(($infos[$immatriculation]['vols'] / $nb_mois), 2);
			}*/

			// Calcul du nombre de fois tombé en panne
			$query = $this->db->query('
				WITH controles AS (
					SELECT controle_apres AS immatriculation
					FROM gsi.vol
					WHERE parapente = \''.$immatriculation.'\'
				)
				SELECT COUNT(*) AS nb_pannes
				FROM gsi.controle_recurrent NATURAL JOIN controles
				WHERE resultat = false;
			');
			$row = $query->row_array();
			$infos[$immatriculation]['pannes'] = $row['nb_pannes'];
		}
		
		return $infos;
	}

	// Ajoute un parapente dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('parapente', $data);
	}


	// Met à jour les informations du parapente d'immatriculation $immatriculation avec les nouvelles informations contenues dans $data.
	public function update($immatriculation, $data) {
		$this->db->update('parapente', $data, array('immatriculation' => $immatriculation));
	}


	// Supprime le parapente d'immatriculation $immatriculation de la base de données.
	public function delete($immatriculation) {
		$this->db->delete('parapente', array('immatriculation' => $immatriculation));
	}


	// Renvoie le nombre de parapentes enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('parapente');
	}

	// Renvoie le parapente ayant eu le plus de pannes (contrôle négatif)
	public function nul() {
		$nul['pannes'] = 0;
		
		if ($this->count() > 0) {
			$misc = $this->getMisc();
			foreach ($misc as $immatriculation => $parapente) {
				if (!isset($nul['immatriculation']) OR ($nul['pannes'] < $parapente['pannes'])) {
					$nul['immatriculation'] = $immatriculation;
					$nul['pannes'] = $parapente['pannes'];
				}
			}
		}

		if (!isset($nul['immatriculation'])) {
			$nul['immatriculation'] = null;
		}
		return $nul;
	}

	// Renvoie le parapente le plus (ou le moins) souvent loué
	public function souventLoue($bool) {
		if ($this->count() > 0) {
			$misc = $this->getMisc();
			foreach ($misc as $immatriculation => $parapente) {
				if (!isset($paraRes['immatriculation'])) {
					$paraRes['immatriculation'] = $immatriculation;
					$paraRes['nbLoue'] = $parapente['locations'];
				} else if ($bool) {
					if ($paraRes['nbLoue'] < $parapente['locations']) {
						$paraRes['immatriculation'] = $immatriculation;
						$paraRes['nbLoue'] = $parapente['locations'];
					}
				} else {
					if ($paraRes['nbLoue'] > $parapente['locations']) {
						$paraRes['immatriculation'] = $immatriculation;
						$paraRes['nbLoue'] = $parapente['locations'];
					}
				}
			}
		}

		if (!isset($paraRes['immatriculation'])) {
			$paraRes['immatriculation'] = null;
		}
		return $paraRes;
	}

	// Renvoie le parapente le plus (ou moins) fiable (% de controles OK)
	public function fiable($paraEtlocations, $bool) {
		// Détermination des fiabilités des parapentes
		foreach ($paraEtlocations as $immat => $mesLocations) {
			$nbCtrPonctuels = 0;
			$nbCtrRecurrents = 0;
			$nbCtrPonctuelsOK = 0;
			$nbCtrRecurrentsOK = 0;

			$this->db->where('parapente', $immat);
			$this->db->from('controle_ponctuel');
			$nbCtrPonctuels = $this->db->count_all_results();

			$array = array('parapente' => $immat, 'resultat' => true);
			$this->db->where($array);
			$this->db->from('controle_ponctuel');
			$nbCtrPonctuelsOK = $this->db->count_all_results();

			foreach ($mesLocations as $loc) {
				$this->db->where('location', $loc['id']);
				$this->db->from('controle_recurrent');
				$nbCtrRecurrents = $this->db->count_all_results();

				$array = array('location' => $loc['id'], 'resultat' => true);
				$this->db->where($array);
				$this->db->from('controle_recurrent');
				$nbCtrRecurrentsOK = $this->db->count_all_results();
			}

			if (($nbCtrPonctuels + $nbCtrRecurrents) > 0) {
				$temp[$immat] = (($nbCtrPonctuelsOK + $nbCtrRecurrentsOK) / ($nbCtrPonctuels + $nbCtrRecurrents)) * 100;
			}
		}

		// Détermination du parapente souhaité
		foreach ($temp as $immat => $fiabilite) {
			if (!isset($paraRes['immatriculation'])) {
				$paraRes['immatriculation'] = $immat;
				$paraRes['fiabilite'] = $fiabilite;
			} else if ($bool) {
				if ($paraRes['fiabilite'] < $fiabilite) {
					$paraRes['immatriculation'] = $immat;
					$paraRes['fiabilite'] = $fiabilite;
				}
			} else {
				if ($paraRes['fiabilite'] > $fiabilite) {
					$paraRes['immatriculation'] = $immat;
					$paraRes['fiabilite'] = $fiabilite;
				}
			}
		}

		return $paraRes;
	}
}