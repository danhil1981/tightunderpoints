<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_bosses extends CI_Model {

        public function get($id) {
            $query = $this->db->query("SELECT * FROM bosses WHERE id = $id;");
            return $query->result_array()[0];
        }

        public function get_all() {
            $query = $this->db->query("SELECT * FROM bosses;");
            $bosses = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $bosses[] = $row;
                }
            }
            return $bosses;
        }

        public function get_list() {
            $query = $this->db->query("SELECT id AS id_boss, name AS name_boss FROM bosses;");
            $bosses = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $bosses[] = $row;
                }
            }
            return array_column($bosses, 'name_boss', 'id_boss');
        }

        public function get_name($id) {
            $query = $this->db->query("SELECT name FROM bosses WHERE id = $id;");
            return $query->row()->name;
        }

        public function get_list_kills($id_boss) {
            $query = $this->db->query("SELECT 
                bosses.name AS name_boss,
                COUNT(events.id_boss) AS total_kills,
                events.timestamp AS first_killed
                FROM bosses 
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = $id_boss
                ORDER BY events.timestamp ASC LIMIT 1
            ;");
            $boss = $query->result_array()[0];
            $query = $this->db->query("SELECT 
                events.timestamp AS last_killed
                FROM bosses 
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = $id_boss
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $boss += $query->result_array()[0];
            }
            return $boss;
        }

        public function get_list_items($id_boss) {
            $query = $this->db->query("SELECT 
                items.name AS name_item,
                COUNT(drops.id_item) AS number_drops
                FROM bosses
                INNER JOIN items ON bosses.id = items.id_boss
                LEFT JOIN drops ON items.id = drops.id_item
                WHERE bosses.id = $id_boss
                GROUP BY items.name
            
            ;");
            $drops = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return $drops;
        }

        public function insert($name, $respawn, $variance, $value) {
            $this->db->query("INSERT INTO bosses (name, respawn, variance, value) VALUES ('$name', '$respawn', '$variance', '$value');");
            return $this->db->affected_rows();
        }

        public function delete($id) {
            $this->db->query("DELETE FROM bosses WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $name, $respawn, $variance, $value) {
            $this->db->query("UPDATE bosses SET name = '$name', respawn = '$respawn', variance = '$variance', value = '$value' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
