<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Events extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT events.id, events.timestamp, events.id_boss, events.id_raid, bosses.name AS name_boss, raids.description AS description_raid FROM events LEFT JOIN bosses ON events.id_boss = bosses.id LEFT JOIN raids ON events.id_raid = raids.id;");
            $events = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $events[] = $row;
                }
            }
            return $events;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM events WHERE id = $id;");
            $event = $query->result_array()[0];
    
            return $event;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM events WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {

            $time = $this->input->post("time");
            $date = $this->input->post("date");
            $timestamp = $date." ".$time;
            
            $id_boss = $this->input->post("id_boss");
            $id_raid = $this->input->post("id_raid");
            
    
            $this->db->query("INSERT INTO events (timestamp, id_boss, id_raid) VALUES ('$timestamp', '$id_boss', '$id_raid');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $time = $this->input->post("time");
            $date = $this->input->post("date");
            $timestamp = $date." ".$time;
            $id_boss = $this->input->post("id_boss");
            $id_raid = $this->input->post("id_raid");
    
            $this->db->query("UPDATE events SET timestamp = '$timestamp', id_boss = '$id_boss', id_raid = '$id_raid' WHERE id = $id;");
    
            return $this->db->affected_rows();
        }

        public function get_list() {
            $query = $this->db->query("SELECT events.id AS id_event, CONCAT(events.timestamp,' - ', bosses.name) AS name_event FROM bosses INNER JOIN events ON events.id_boss = bosses.id;");
            $bosses = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $bosses[] = $row;
                }
            }
            return array_column($bosses, 'name_event', 'id_event');
        }

        public function events_in_raid($id_raid) {
            $query = $this->db->query("SELECT 
            events.id AS id_event, CONCAT(events.timestamp,' - ', bosses.name) AS name_event 
            FROM bosses 
            INNER JOIN events ON events.id_boss = bosses.id
            WHERE id_raid = '$id_raid';
            ");
            $events_in_raid = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $events_in_raid[] = $row;
                }
            }
            return array_column($events_in_raid, 'name_event', 'id_event');
        }

        public function events_not_in_raid() {
            $query = $this->db->query("SELECT 
            events.id AS id_event, CONCAT(events.timestamp,' - ', bosses.name) AS name_event 
            FROM bosses 
            INNER JOIN events ON events.id_boss = bosses.id
            WHERE id_raid = 0;
            ");
            $events_not_raid = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $events_not_raid[] = $row;
                }
            }
            return array_column($events_not_raid, 'name_event', 'id_event');
        }

        public function get_boss($id_event) {
            $query = $this->db->query("SELECT
                id_boss FROM events WHERE id = $id_event;
            ");
            $id_boss = implode($query->result_array()[0]);
            return $id_boss;
        }

    }

?>
