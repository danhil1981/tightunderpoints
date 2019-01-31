<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Officers extends CI_Model {

        public function insert_event($time, $date, $id_boss, $id_raid) {
            $timestamp = $date." ".$time;
            $this->db->query("INSERT INTO events (timestamp, id_boss, id_raid ) VALUES ('$timestamp', '$id_boss', '$id_raid');");
            $output = 0;
            if ($this->db->affected_rows() == 1) {
                $output = $this->db->insert_id().",".$timestamp.":00 - ".$this->model_bosses->get_name($id_boss);
            }
            return $output;
        }

        public function insert_raid($description,$date) {
            $this->db->query("INSERT INTO raids (description, date ) VALUES ('$description', '$date');");
            $output = 0;
            if ($this->db->affected_rows() == 1) {
                $output = $this->db->insert_id();
            }
            return $output;
        }

        public function get_timers() {
            $query = $this->db->query("SELECT 
            bosses.id AS 'id_boss',
            bosses.name AS 'name_boss', 
            events.timestamp AS 'last_killed',
            ADDTIME(ADDTIME(events.timestamp, bosses.respawn),-bosses.variance) AS 'start_window',
            ADDTIME(ADDTIME(events.timestamp, bosses.respawn),bosses.variance) AS 'end_window'
            FROM bosses 
            INNER JOIN events ON bosses.id = events.id_boss
            WHERE events.timestamp = (SELECT MAX(events.timestamp) FROM events WHERE bosses.id = events.id_boss);
            ");
            $timers = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $timers[] = $row;
                }
            }
            return $timers;
        }

        public function insert_item($id_item, $name_item, $id_boss, $value_item) {
            $this->db->query("INSERT INTO items (id, name, id_boss, value) VALUES ('$id_item', '$name_item','$id_boss', '$value_item');");
            $output = 0;
            if ($this->db->affected_rows() == 1) {
                $output = 1;
            }
            return $output;
        }

        public function insert_drop_loot() {
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

    }
?>
