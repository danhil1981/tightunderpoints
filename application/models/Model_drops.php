<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Drops extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT drops.id, drops.id_event, drops.id_item, CONCAT(events.timestamp,' - ', bosses.name) AS name_event, items.name AS name_item FROM drops INNER JOIN events ON drops.id_event = events.id INNER JOIN items ON drops.id_item = items.id INNER JOIN bosses ON events.id_boss = bosses.id ;");
            $drops = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return $drops;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM drops WHERE id = $id;");
            $drop = $query->result_array()[0];
    
            return $drop;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM drops WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $id_event = $this->input->post('id_event');
            $id_item = $this->input->post('id_item');
    
            $this->db->query("INSERT INTO drops (id_event, id_item) VALUES ('$id_event', '$id_item');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $id_event = $this->input->post('id_event');
            $id_item = $this->input->post('id_item');
    
            $this->db->query("UPDATE drops SET id_event = '$id_event', id_item = '$id_item' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }

        public function get_list() {
            $query = $this->db->query("SELECT 
            drops.id AS id_drop, 
            CONCAT(events.timestamp,' - ', items.name) AS name_drop 
            FROM drops
            INNER JOIN events ON drops.id_event = events.id
            INNER JOIN items ON drops.id_item = items.id
            ;");
            $drops = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return array_column($drops, 'name_drop', 'id_drop');
        }

    }

?>
