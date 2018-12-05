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
    
            $this->db->query("INSERT INTO players (name) VALUES ('$name');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
    
            $this->db->query("UPDATE players SET name = '$name' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }

        public function get_list() {
            $query = $this->db->query("SELECT id AS id_player, name AS name_player FROM players ORDER BY name ASC;");
            $players = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $players[] = $row;
                }
            }
            return array_column($players, 'name_player', 'id_player');
        }
    }

?>
