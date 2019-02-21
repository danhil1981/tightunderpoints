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
