<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_loot extends CI_Model {

        public function get($id) {
            $query = $this->db->query("SELECT * FROM loot WHERE id = $id;");
            return $query->result_array()[0];
        }

        public function get_all() {
            $query = $this->db->query("SELECT
            loot.id, loot.id_drop, loot.id_character,
            events.timestamp AS timestamp,
            items.name AS name_item,
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

        public function insert($id_drop, $id_character) {
            $this->db->query("INSERT INTO loot (id_drop, id_character) VALUES ('$id_drop', '$id_character');");
            return $this->db->affected_rows();
        }

        public function officer_insert() {
            $id_item = $this->input->post("id_item");
            $id_event = $this->input->post("id_event");
            $id_character = $this->input->post("id_character");
            $output = 0;
            $this->db->query("INSERT INTO drops (id_event, id_item) VALUES ('$id_event', '$id_item');");
            if($this->db->affected_rows() != 0) {
                $output = 1;
                $id_drop = $this->db->insert_id();
                $this->db->query("INSERT INTO loot (id_drop, id_character) VALUES ('$id_drop', $id_character);");
                if($this->db->affected_rows() != 0) {
                    $output = 2;
                }
            }
            return $output;
        }

        public function delete($id) {
            $this->db->query("DELETE FROM loot WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $id_drop, $id_character) {
            $this->db->query("UPDATE loot SET id_drop = '$id_drop', id_character = '$id_character' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
