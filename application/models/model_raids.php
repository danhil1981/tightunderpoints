<?php

    class Model_raids extends CI_Model {

        public function get($id) {
            $query = $this->db->query("SELECT
                * FROM raids
                WHERE id = '$id'
            ;");
            return $query->result_array()[0];
        }

        public function get_all() {
            $query = $this->db->query("SELECT
                * FROM raids
            ;");
            $raids = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $raids[] = $row;
                }
            }
            return $raids;
        }

        public function get_list() {
            $query = $this->db->query("SELECT
                id AS id_raid,
                CONCAT(date, ' - ',description) AS description_raid
                FROM raids
            ;");
            $raids = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $raids[] = $row;
                }
            }
            return array_column($raids, "description_raid", "id_raid");
        }

        public function insert($description, $date) {
            $this->db->query("INSERT
                INTO raids (description, date )
                VALUES ('$description', '$date')
            ;");
            return $this->db->affected_rows();
        }

        public function officer_insert($description,$date) {
            $this->db->query("INSERT
                INTO raids (description, date )
                VALUES ('$description', '$date')
            ;");
            $output = 0;
            if ($this->db->affected_rows() == 1) {
                $output = $this->db->insert_id();
            }
            return $output;
        }

        public function delete($id) {
            $this->db->query("DELETE
                FROM raids
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $description, $date) {
            $this->db->query("UPDATE
                raids SET
                description = '$description',
                date = '$date'
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }

    }

?>
