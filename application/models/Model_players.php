<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Players extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT * FROM players;");
            $players = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $players[] = $row;
                }
            }
            return $players;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM players WHERE id = $id;");
            $player = $query->result_array()[0];
    
            return $player;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM players WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $name = $this->input->post('name');
    
            $this->db->query("INSERT INTO players (name, last_raid, last_loot, points) VALUES ('$name', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
    
            $this->db->query("UPDATE players SET name = '$name' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }
    }

?>
