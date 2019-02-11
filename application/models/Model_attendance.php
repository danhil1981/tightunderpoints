<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_attendance extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT
                attendance.id, attendance.id_event, attendance.id_character,
                characters.name AS name_character,
                CONCAT(events.timestamp,' - ', bosses.name) AS name_event
                FROM attendance
                INNER JOIN characters ON attendance.id_character = characters.id
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
            ;");
            $attendance = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $attendance[] = $row;
                }
            }
            return $attendance;
        }

        public function get($id) {
            $query = $this->db->query("SELECT * FROM attendance WHERE id = $id;");
            $attendance_entry = $query->result_array()[0];
            return $attendance_entry;
        }

        public function get_played() {
            $query = $this->db->query("SELECT
                attendance.id_event,
                characters.name AS name_character
                FROM attendance
                INNER JOIN characters ON attendance.id_points = characters.id
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
            ;");
            $attendance = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $attendance[] = $row;
                }
            }
            return $attendance;
        }

        public function delete($id) {
            $this->db->query("DELETE FROM attendance WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function insert() {
            $id_event = $this->input->post("id_event");
            $id_character = $this->input->post("id_character");
            $id_points = $this->input->post("id_points");
            $this->db->query("INSERT INTO attendance (id_event, id_character, id_points) VALUES ('$id_event', '$id_character', '$id_points');");
            return $this->db->affected_rows();
        }

        public function modify() {
            $id = $this->input->post('id');
            $id_event = $this->input->post("id_event");
            $id_character = $this->input->post("id_character");
            $id_points = $this->input->post("id_points");
            $this->db->query("UPDATE attendance SET id_event = '$id_event', id_character = '$id_character', id_points = '$id_points' WHERE id = $id;");
            return $this->db->affected_rows();
        }

        public function officer_insert() {
            $id_event = $this->input->post("id_event");
            $characters = array();
            $substitutions = array();
            $output = 0;
            foreach($_POST as $key => $value) {
                if (strpos($key, 'character_') === 0) {
                    array_push($characters,substr($key,10));
                }
                else if (strpos($key, 'id_substituting_') === 0) {
                    if ($value == 0) {
                        array_push($substitutions,substr($key,16));
                    }
                    else {
                        array_push($substitutions,$value);
                    }
                }
            }
            if(count($substitutions) == count($characters)) {
                $output = 1;
            }
            $count_inserts = count($characters);
            $count_success = 0;
            for ($i = 0; $i < count($characters); $i++) {
                $this->db->query("INSERT INTO attendance (id_event, id_character, id_points) VALUES ($id_event, $characters[$i], $substitutions[$i]);");
                $count_success += $this->db->affected_rows();
            }
            if ($count_success == $count_inserts) {
                $output = 2;
            }
            return $output;
        }

    }

?>
