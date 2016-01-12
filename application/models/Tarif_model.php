<?php
class Tarif_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue tarif
	public function getFields() {
		return $this->db->list_fields('tarif');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('tarif') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des tarifs répondant aux critères spécifiés.
	public function get($data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by('defaut', 'DESC');
		return $this->db->get('tarif');
	}

	// Renvoie le tarif par défaut actuel
	public function getDefault() {
		return $this->get()->result_array()[0];
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les tarifs.
	 * 		Infos : 
	 */
	public function getMisc() {
		$query_result = $this->get();
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $tarif) {
			$id = $tarif['id'];
		}
		
		return $infos;
	}

	// Ajoute un tarif dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('tarif', $data);
	}


	// Met à jour les informations du tarif d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('tarif', $data, array('id' => $id));
	}


	// Supprime le tarif d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('tarif', array('id' => $id));
	}


	// Renvoie le nombre de tarifs enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('tarif');
	}
}