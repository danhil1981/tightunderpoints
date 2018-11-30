<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Users extends CI_Model {

        public function validate() {
            $validated = false;

            $username = $this->input->post('user');
            $password = $this->input->post('password');

            $query = $this->db->query("SELECT type FROM users WHERE name='$username' AND password='$password';");
            

            if($query->num_rows() == 1) {
                $validated = true;
                $type = implode($query->result_array()[0]);
                $session_data = array('logged_in' => TRUE,'username' => $username, 'type' => $type);
                $this->session->set_userdata($session_data);
            }

        return $validated;
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

        public function get($id) {
            $query = $this->db->query("SELECT * FROM users WHERE id = $id;");
            $user = $query->result_array()[0];
    
            return $user;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM users WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $name = $this->input->post('name');
    
            $this->db->query("INSERT INTO users (name) VALUES ('$name');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
    
            $this->db->query("UPDATE users SET name = '$name' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }
    }
?>
