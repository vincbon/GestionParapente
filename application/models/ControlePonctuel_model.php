<?php
class ControlePonctuel_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue Controle_ponctuel
	public function getFields() {
		return $this->db->list_fields('controle_ponctuel');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('controle_ponctuel') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des contrôles techniques ponctuels répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('controle_ponctuel');
	}

	// Ajoute un contrôle technique ponctuel dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('controle_ponctuel', $data);
	}

	// Met à jour les informations du contrôle technique ponctuel d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('controle_ponctuel', $data, array('id' => $id));
	}

	// Supprime le contrôle technique ponctuel d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('controle_ponctuel', array('id' => $id));
	}

	// Renvoie le nombre de contrôles techniques ponctuels enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('controle_ponctuel');
	}

	// Renvoie le nombre de contrôles techniques ponctuels OK.
	public function countOK() {
		$query = $this->db->query('
				SELECT COUNT(*) AS nb_ok
				FROM gsi.controle_ponctuel
				WHERE resultat = true;
			');
		$row = $query->row_array();
		return $row['nb_ok'];
	}
}