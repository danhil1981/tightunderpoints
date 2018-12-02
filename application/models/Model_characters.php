<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Characters extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT characters.id, characters.name, characters.level, characters.class, characters.type, characters.id_player, players.name AS name_player FROM characters LEFT JOIN players ON characters.id_player = players.id;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return $characters;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM characters WHERE id = $id;");
            $character = $query->result_array()[0];
            return $character;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM characters WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $name = $this->input->post('name');
            $level = $this->input->post('level')+1;
            $class = $this->input->post('class');
            $type = $this->input->post('type');
            $id_character = $this->input->post('id_player');
    
            $this->db->query("INSERT INTO characters (name, level, class, type, id_player) VALUES ('$name', '$level', '$class', '$type', '$id_character');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $level = $this->input->post('level')+1;
            $type = $this->input->post('type');
            $id_player = $this->input->post('id_player');
    
            $this->db->query("UPDATE characters SET name = '$name', level = '$level', type = '$type', id_player = '$id_player' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }
    }

?>
