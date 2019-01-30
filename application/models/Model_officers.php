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

    }
?>
