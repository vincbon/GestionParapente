<?php
class Pilote_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue Pilote
	public function getFields() {
		return $this->db->list_fields('pilote');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('pilote') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des pilotes répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('pilote');
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les pilotes.
	 * 		Infos : Nombre de vols réalisés : total et moyenne par mois.
	 *				Chiffre d'affaire crée.
	 *				Nombre de parapentes endommagés (contrôle négatif après vol).
	 */
	public function getMisc() {
		$query_result = $this->get('id', null, null);
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $pilote) {
			$id = $pilote['id'];

			// Calcul du nombre de vols total
			$this->db->where('pilote', $id);
			$this->db->from('vol');
			$infos[$id]['locations'] = $this->db->count_all_results();

			// Calcul du nombre moyen de vols par mois
			$res = pg_query_params("SELECT * FROM GSI.F_PILOTE_GETMOIS($1)", array($id));
			$nb_mois = pg_fetch_result($res, 0, 0);
			if ($nb_mois == 0) {
				$infos[$id]['locations_par_mois'] = $infos[$id]['locations'];
			} else {
				$infos[$id]['locations_par_mois'] = round(($infos[$id]['locations'] / $nb_mois), 2);
			}

			// Calcul du chiffre d'affaire
			$this->db->select_sum('prix', 'total');
			$this->db->where('pilote', $id);
			$query = $this->db->get('vol');
			$row = $query->row_array();
			if ($row['total'] == null) {
				$row['total'] = 0;
			}
			$infos[$id]['chiffre_d\'affaires (€)'] = $row['total'];
			

			// Calcul du nombre de parapentes endommagés
			$query = $this->db->query('
				WITH controles AS (
					SELECT controle_apres AS id
					FROM gsi.vol
					WHERE pilote = \''.$id.'\'
				)
				SELECT COUNT(*) AS nb_endommages
				FROM gsi.controle_recurrent NATURAL JOIN controles
				WHERE resultat = false;
			');
			$row = $query->row_array();
			$infos[$id]['parapentes_endommagés'] = $row['nb_endommages'];
		}
		
		return $infos;
	}

	// Ajoute un pilote dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('pilote', $data);
	}


	// Met à jour les informations du pilote d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('pilote', $data, array('id' => $id));
	}


	// Supprime le pilote d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('pilote', array('id' => $id));
	}


	// Renvoie le nombre de pilotes enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('pilote');
	}

	// Renvoie le nombre de locations moyen par pilote
	public function locationsMoyennes() {
		$locations = 0;

		if ($this->count() > 0) {
			$misc = $this->getMisc();
			foreach($misc as $pilote) {
				$locations = $locations + $pilote['locations'];
			}
			$locations = $locations / $this->count();
		}

		return $locations;
	}

	// Renvoie le CA moyen par pilote
	public function caMoyen() {
		$CA = 0;

		if ($this->count() > 0) {
			$misc = $this->getMisc();
			foreach($misc as $pilote) {
				$CA = $CA + $pilote['chiffre_d\'affaires (€)'];
			}
			$CA = $CA / $this->count();
		}

		return $CA;
	}

	// Renvoie le pilote ayant le CA le plus élevé.
	public function meilleur() {
		$meilleur['CA'] = 0;
		
		if ($this->count() > 0) {
			$misc = $this->getMisc();
			foreach ($misc as $id => $pilote) {
				if (!isset($meilleur['id']) OR ($meilleur['CA'] < $pilote['chiffre_d\'affaires (€)'])) {
					$meilleur['id'] = $id;
					$meilleur['CA'] = $pilote['chiffre_d\'affaires (€)'];
				}
			}
		}

		if (!isset($meilleur['id'])) {
			$meilleur['id'] = null;
		}
		return $meilleur;
	}
}