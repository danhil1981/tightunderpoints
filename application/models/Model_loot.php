<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_loot extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT
            loot.id, loot.id_drop, loot.id_character,
            characters.name AS name_character,
            CONCAT(events.timestamp,' - ', items.name) AS name_drop
            FROM loot
            INNER JOIN characters ON loot.id_character = characters.id
            INNER JOIN drops ON loot.id_drop = drops.id
            INNER JOIN items ON drops.id_item = items.id
            INNER JOIN events ON drops.id_event = events.id
            ;");
            $loot = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $loot[] = $row;
                }
            }
            return $loot;
        }

        public function get($id) {
            $query = $this->db->query("SELECT * FROM loot WHERE id = $id;");
            return $query->result_array()[0];
        }

        public function delete($id) {
            $this->db->query("DELETE FROM loot WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function insert() {
            $id_drop = $this->input->post("id_drop");
            $id_character = $this->input->post("id_character");
            $this->db->query("INSERT INTO loot (id_drop, id_character) VALUES ('$id_drop', '$id_character');");
            return $this->db->affected_rows();
        }

        public function modify() {
            $id = $this->input->post('id');
            $id_drop = $this->input->post("id_drop");
            $id_character = $this->input->post("id_character");
            $this->db->query("UPDATE loot SET id_drop = '$id_drop', id_character = '$id_character' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
