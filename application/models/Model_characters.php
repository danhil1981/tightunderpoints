<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_characters extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT
                characters.id, characters.name, characters.level, characters.class, characters.type, characters.id_player,
                players.name AS name_player
                FROM characters LEFT JOIN players ON characters.id_player = players.id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return $characters;
        }

        public function get($id) {
            $query = $this->db->query("SELECT * FROM characters WHERE id = $id;");
            $character = $query->result_array()[0];
            return $character;
        }

        public function get_name($id) {
            $query = $this->db->query("SELECT name FROM characters WHERE id = $id;");
            $name = $query->result_array()[0];
            return $name;
        }

        public function delete($id) {
            $this->db->query("DELETE FROM characters WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function insert() {
            $name = $this->input->post('name');
            $level = $this->input->post('level')+1;
            $class = $this->input->post('class');
            $type = $this->input->post('type');
            $id_character = $this->input->post('id_player');
            $this->db->query("INSERT INTO characters (name, level, class, type, id_player) VALUES ('$name', '$level', '$class', '$type', '$id_character');");
            return $this->db->affected_rows();
        }

        public function modify() {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $level = $this->input->post('level')+1;
            $type = $this->input->post('type');
            $id_player = $this->input->post('id_player');
            $this->db->query("UPDATE characters SET name = '$name', level = '$level', type = '$type', id_player = '$id_player' WHERE id = $id;");
            return $this->db->affected_rows();
        }

        public function get_list_names() {
            $query = $this->db->query("SELECT id AS id_character, name AS name_character FROM characters;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, 'name_character', 'id_character');
        }

        public function get_list_mains() {
            $query = $this->db->query("SELECT id AS id_character, name AS name_character FROM characters WHERE type = 1 ORDER BY name;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, 'name_character', 'id_character');
        }

        public function get_list_total_earned() {
            $query = $this->db->query("SELECT
                characters.id AS id_character, IFNULL(SUM(bosses.value),0) AS total_earned
                FROM characters
                LEFT JOIN attendance ON characters.id = attendance.id_points
                LEFT JOIN events ON attendance.id_event = events.id
                LEFT JOIN bosses ON events.id_boss = bosses.id
                GROUP BY characters.id
            ;");
            $list_total_earned = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $list_total_earned[] = $row;
                }
            }
            return array_column($list_total_earned, 'total_earned', 'id_character');
        }

        public function get_list_last50_earned() {
            $query = $this->db->query("SELECT
	            characters.id AS id_character, 0 AS last50_earned
                FROM characters
                ORDER BY id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            $characters = array_column($characters, 'last50_earned', 'id_character');
            $query = $this->db->query("SELECT
                characters.id AS id_character, IFNULL(SUM(bosses.value),0) AS last50_earned
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY)
                GROUP BY characters.id
            ;");
            $characters_with_points = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters_with_points[] = $row;
                }
            }
            $characters_with_points = array_column($characters_with_points, 'last50_earned', 'id_character');
            $list_last50_earned = array();
            foreach ($characters as $i => $id[0]) {
                if(isset($characters_with_points[$i])) {
                    $list_last50_earned[$i] = $characters[$i] + $characters_with_points[$i];
                }
                else {
                    $list_last50_earned[$i] = 0;
                }
            }
            return $list_last50_earned;
        }

        public function get_list_total_spent() {
            $query = $this->db->query("SELECT
                characters.id AS id_character, IFNULL(SUM(items.value),0) AS total_spent
                FROM characters
                LEFT JOIN loot ON characters.id = loot.id_character
                LEFT JOIN drops ON loot.id_drop = drops.id
                LEFT JOIN items ON drops.id_item = items.id
                GROUP BY characters.id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, 'total_spent', 'id_character');
        }

        public function get_list_last50_spent() {
            $query = $this->db->query("SELECT
	            characters.id as id_character, 0 AS last50_spent
                FROM characters
                ORDER BY id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            $characters = array_column($characters, 'last50_spent', 'id_character');
            $query = $this->db->query("SELECT
                characters.id AS id_character, IFNULL(SUM(items.value),0) AS last50_spent
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events on drops.id_event = events.id
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY)
                GROUP BY characters.id
            ;");
            $characters_with_points = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters_with_points[] = $row;
                }
            }
            $characters_with_points = array_column($characters_with_points, 'last50_spent', 'id_character');
            $list_last50_spent = array();
            foreach ($characters as $i => $id[0]) {
                if(isset($characters_with_points[$i])) {
                    $list_last50_spent[$i] = $characters[$i] + $characters_with_points[$i];
                }
                else {
                    $list_last50_spent[$i] = 0;
                }
            }
            return $list_last50_spent;
        }

        public function get_list_types() {
            $query = $this->db->query("SELECT id AS id_character, type AS type_character FROM characters;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, 'type_character', 'id_character');
        }

    }

?>
