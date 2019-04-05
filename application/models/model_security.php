<?php

    class Model_security extends CI_Model
    {
        public function validate_user($username, $password)
        {
            $validated = false;
            $query = $this->db->query("SELECT
                type
                FROM users
                WHERE name = '$username'
                AND password = '$password'
            ;");
            if ($query->num_rows() == 1) {
                $validated = true;
                $type = implode($query->result_array()[0]);
                $session_data = array(
                    'logged_in' => true,
                    'username' => $username,
                    'type' => $type
                );
                $this->session->set_userdata($session_data);
            }
            return $validated;
        }
    }
