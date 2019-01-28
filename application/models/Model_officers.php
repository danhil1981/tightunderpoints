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

    }
?>
