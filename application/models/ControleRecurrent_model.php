<?php
class ControleRecurrent_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue Controle_recurrent
	public function getFields() {
		return $this->db->list_fields('controle_recurrent');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('controle_recurrent') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des contrôles techniques récurrents répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('controle_recurrent');
	}

	// Ajoute un contrôle technique récurrent dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('controle_recurrent', $data);
	}

	// Met à jour les informations du contrôle technique récurrent d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('controle_recurrent', $data, array('id' => $id));
	}

	// Supprime le contrôle technique récurrent d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('controle_recurrent', array('id' => $id));
	}

	// Renvoie le nombre de contrôles techniques récurrents enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('controle_recurrent');
	}

	// Renvoie le nombre de contrôles techniques récurrents OK.
	public function countOK() {
		$query = $this->db->query('
				SELECT COUNT(*) AS nb_ok
				FROM gsi.controle_recurrent
				WHERE resultat = true;
			');
		$row = $query->row_array();
		return $row['nb_ok'];
	}
}