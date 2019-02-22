<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_users extends CI_Model {

        public function get($id) {
            $query = $this->db->query("SELECT * FROM users WHERE id = $id;");
            return $query->result_array()[0];
        }

        public function get_all() {
            $query = $this->db->query("SELECT * FROM users;");
            $users = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $users[] = $row;
                }
            }
            return $users;
        }

        public function insert($name, $password, $type) {
            $this->db->query("INSERT INTO users (name, password, type) VALUES ('$name', '$password', '$type');");
            return $this->db->affected_rows();
        }

        public function delete($id) {
            $this->db->query("DELETE FROM users WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $name, $password, $type) {
            $this->db->query("UPDATE users SET name = '$name', password = '$password', type = '$type' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
