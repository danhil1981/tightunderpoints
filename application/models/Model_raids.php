<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Raids extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT * FROM raids;");
            $raids = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $raids[] = $row;
                }
            }
            return $raids;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM raids WHERE id = $id;");
            $raid = $query->result_array()[0];
    
            return $raid;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM raids WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $description = quotes_to_entities($this->input->post('description'));
            $date = $this->input->post("date");
            
    
            $this->db->query("INSERT INTO raids (description, date ) VALUES ('$description', '$date');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $description = quotes_to_entities($this->input->post('description'));
            $date = $this->input->post('date');
    
            $this->db->query("UPDATE raids SET description = '$description', date = '$date' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }

        public function get_list() {
            $query = $this->db->query("SELECT id AS id_raid, date AS date_raid FROM raids;");
            $raids = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $raids[] = $row;
                }
            }
            return array_column($raids, 'date_raid', 'id_raid');
        }
    }

?>
