<?php
class Parcours_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue parcours
	public function getFields() {
		return $this->db->list_fields('parcours');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('parcours') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des parcourss répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('parcours');
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les parcours.
	 * 		Infos : Nombre de locations liées
	 */
	public function getMisc() {
		$query_result = $this->get('id', null, null);
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $parcours) {
			$id = $parcours['id'];

			// Calcul du nombre de locations liées
			$this->db->where('parcours', $id);
			$this->db->from('vol');
			$infos[$id]['locations_liées'] = $this->db->count_all_results();
		}
		
		return $infos;
	}

	// Ajoute un parcours dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('parcours', $data);
	}


	// Met à jour les informations du parcours d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('parcours', $data, array('id' => $id));
	}


	// Supprime le parcours d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('parcours', array('id' => $id));
	}


	// Renvoie le nombre de parcourss enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('parcours');
	}

	// Renvoie le parcours le plus (ou le moins) utilisé
	public function utilise($bool) {
		if ($bool) {
			$AG = 'MAX';
		} else {
			$AG = 'MIN';
		}
		$query = $this->db->query('
			WITH temp AS (
				SELECT parcours as id, COUNT(*) as nbUtilise
				FROM gsi.vol
				GROUP BY parcours
			)
			SELECT *
			FROM temp
			WHERE nbUtilise = (SELECT '.$AG.'(nbUtilise) FROM temp);
		');
		
		$row = $query->row_array();
		$parc['id'] = $row['id'];
		$parc['nbUtilise'] = $row['nbutilise'];
		return $parc;
	}
}