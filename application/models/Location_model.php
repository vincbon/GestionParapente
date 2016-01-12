<?php
class Location_model extends CI_Model {
	
	// Constructeur
	public function __construct() {
		$this->load->database();
	}

	// Renvoie un array contenant les noms des champs de la vue vol
	public function getFields() {
		return $this->db->list_fields('vol');
	}

	public function getFieldsMetaData() {
		foreach($this->db->field_data('vol') as $num_field => $field) {
			$metadata[$num_field]['name'] = $field->name;
			$metadata[$num_field]['type'] = $field->type;
		}
		return $metadata;
	}

	// Renvoie une query comportant les données des vols répondant aux critères spécifiés.
	public function get($orderby = 'id', $data_equal = null, $data_like = null) {
		if ($data_equal != null) {
			$this->db->where($data_equal);
		}
		if ($data_like != null) {
			$this->db->like($data_like);
		}
		$this->db->order_by($orderby, 'ASC');
		return $this->db->get('vol');
	}

	/* Renvoie un array contenant des informations supplémentaires sur tous les vols.
	 * 		Infos : 
	 */
	public function getMisc() {
		$query_result = $this->get('id', null, null);
		$array = $query_result->result_array();
		$infos = null;

		foreach($array as $vol) {
			$id = $vol['id'];
		}
		
		return $infos;
	}

	// Ajoute un vol dans la base de données avec les informations contenues dans $data.
	public function add($data) {
		$this->db->insert('vol', $data);
	}


	// Met à jour les informations du vol d'id $id avec les nouvelles informations contenues dans $data.
	public function update($id, $data) {
		$this->db->update('vol', $data, array('id' => $id));
	}


	// Supprime le vol d'id $id de la base de données.
	public function delete($id) {
		$this->db->delete('vol', array('id' => $id));
	}


	// Renvoie le nombre de vols enregistrés dans la base de données.
	public function count() {
		return $this->db->count_all('vol');
	}

	// Renvoie le nombre moyen de locations par mois.
	public function nbParMois() {
		$nbTotal = $this->count();
		$res = pg_query("SELECT * FROM GSI.F_VOL_GETMOIS()");
		$nb_mois = pg_fetch_result($res, 0, 0);

		if ($nb_mois == 0) {
			$nbParMois = $nbTotal;
		} else {
			$nbParMois = $nbTotal / $nb_mois;
		}
		return  $nbParMois;
	}

	// Renvoie le chiffre d'affaires moyen par mois.
	public function caMoyenParMois() {
		$CA = $this->caTotal();
		$res = pg_query("SELECT * FROM GSI.F_VOL_GETMOIS()");
		$nb_mois = pg_fetch_result($res, 0, 0);

		if ($nb_mois == 0) {
			$caParMois = $CA;
		} else {
			$caParMois = $CA / $nb_mois;
		}
		return  $caParMois;
	}

	// Renvoie le chiffre d'affaires total.
	public function caTotal() {
		$this->db->select_sum('prix', 'total');
		$query = $this->db->get('vol');
		$row = $query->row_array();
		if ($row['total'] == null) {
			$row['total'] = 0;
		}
		return $row['total'];
	}

	// Renvoie le chiffre d'affaires des 30 derniers jours.
	public function caDernierMois() {
		$query = $this->db->query('
			SELECT SUM(prix) AS total
			FROM gsi.vol
			WHERE age(date) <= make_interval(days := 30);
		');
		$row = $query->row_array();
		if ($row['total'] == null) {
			$row['total'] = 0;
		}
		return $row['total'];
	}

	// Renvoie le CA moyen par location
	public function caMoyenParLocation() {
		return $this->caTotal() / $this->count();
	}
}