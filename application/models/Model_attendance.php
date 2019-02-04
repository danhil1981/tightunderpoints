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
                ORDER BY characters.name
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

        public function delete($id) {
            $this->db->query("DELETE FROM attendance WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function insert() {
            $id_event = $this->input->post("id_event");
            $id_character = $this->input->post("id_character");
            $this->db->query("INSERT INTO attendance (id_event, id_character) VALUES ('$id_event', '$id_character');");
            return $this->db->affected_rows();
        }

        public function modify() {
            $id = $this->input->post('id');
            $id_event = $this->input->post("id_event");
            $id_character = $this->input->post("id_character");
            $this->db->query("UPDATE attendance SET id_event = '$id_event', id_character = '$id_character' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
