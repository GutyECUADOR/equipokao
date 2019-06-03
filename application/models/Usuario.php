<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {

    public function __construct(){
        parent::__construct();
         $this->load->database();
     }

    public function insert($data) {
        // Inserting into your table
        $this->db->insert('usuarios', $data);
        // Return the id of inserted row
        return $idOfInsertedData = $this->db->insert_id();
    }


    public function insertDetailsDeportes($data) {
        // Inserting into your table
        $this->db->insert('seleccionesdeportes', $data);
        // Return the id of inserted row
        return $idOfInsertedData = $this->db->insert_id();
    }

    public function insertDetailsMarcas($data) {
        // Inserting into your table
        $this->db->insert('seleccionesmarcas', $data);
        // Return the id of inserted row
        return $idOfInsertedData = $this->db->insert_id();
    }

   

}