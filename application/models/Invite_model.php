<?php
class Invite_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue invite
	public function getFields() {
		return $this->db->list_fields('invite');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('invite') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des invites répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('invite');
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les invites.
	 * 		Infos : Nombre de vols réalisés : total et moyenne par mois.
	 *				Chiffre d'affaire crée.
	 */
	public function getMisc() {
		$query_result = $this->get('id', null, null);
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $invite) {
			$id = $invite['id'];

			// Calcul du nombre de vols total
			$this->db->where('invite', $id);
			$this->db->from('vol');
			$infos[$id]['locations'] = $this->db->count_all_results();

			// Calcul du nombre moyen de vols par mois
			$res = pg_query_params("SELECT * FROM GSI.F_INVITE_GETMOIS($1)", array($id));
			$nb_mois = pg_fetch_result($res, 0, 0);
			if ($nb_mois == 0) {
				$infos[$id]['locations_par_mois'] = $infos[$id]['locations'];
			} else {
				$infos[$id]['locations_par_mois'] = round(($infos[$id]['locations'] / $nb_mois), 2);
			}

			// Calcul du chiffre d'affaire
			$this->db->select_sum('prix', 'total');
			$this->db->where('invite', $id);
			$query = $this->db->get('vol');
			$row = $query->row_array();
			if ($row['total'] == null) {
				$row['total'] = 0;
			}
			$infos[$id]['chiffre_d\'affaire (€)'] = $row['total'];
		}
		
		return $infos;
	}

	// Ajoute un invite dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('invite', $data);
	}


	// Met à jour les informations du invite d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('invite', $data, array('id' => $id));
	}


	// Supprime le invite d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('invite', array('id' => $id));
	}


	// Renvoie le nombre de invites enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('invite');
	}
}