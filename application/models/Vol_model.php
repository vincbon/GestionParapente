<?php
class Vol_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie une query comportant les données de tous les vols.
	public function getAllVols() {
		return $this->db->get('vol');
	}

	// Renvoie une query comportant les données du vol d'id $id.
	public function getVol($id) {
		return $this->db->get_where('vol', array('id' => $id));
	}

	// Ajoute un vol dans la base de données avec les informations contenues dans $data.
	public function addVol($data) {
		$this->db->insert('vol', $data);
	}

	// Met à jour les informations du vol d'id $id avec les nouvelles informations contenues dans $data.
	public function updateVol($id, $data) {
		$this->db->update('vol', $data, array('id' => $id));
	}

	// Supprime le vol d'id $id de la base de données.
	public function deleteVol($id) {
		$this->db->delete('vol', array('id' => $id));
	}

	// Renvoie le nombre de vols enregistrés dans la base de données.
	public function countVols() {
		return $this->db->count_all('vol');
	}
}