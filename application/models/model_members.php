<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_members extends CI_Model {

        public function get_max() {
            $comparing = $this->input->post("comparing");
            $max_points = -32000;
            $max_type = 3;
            for ($i = 0; $i < count($comparing); $i+=3) {
                $id = $comparing[$i];
                $points = $comparing[$i+1];
                $type = $comparing[$i+2];
                if ($type < $max_type) {
                    $max_points = $points;
                    $max_type = $type;
                    $multiples = array();
                    array_push($multiples, $id);
                }
                else {
                    if ($type == $max_type) {
                        if ($points > $max_points) {
                            $max_points = $points;
                            $multiples = array();
                            array_push($multiples, $id); 
                        }
                        else if ($points == $max_points) {
                            array_push($multiples, $id); 
                        }
                    }
                }
            }
            if (count($multiples) == 1) {
                $query = $this->db->query("SELECT name FROM characters WHERE id = $multiples[0];");
                $names = implode($query->result_array()[0]);
            }
            else {
                foreach ($multiples as $value) {
                    $query = $this->db->query("SELECT name FROM characters WHERE id = $value;");
                    if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                            $name[] = $row;
                        }
                    }
                }
                $names = implode(', ',array_column($name, 'name'));
            }
            return $names;
        }

        public function show_character($id_character) {
            $query = $this->db->query("SELECT
                characters.name AS 'name_character',
                characters.level AS 'level_character',
                characters.class AS 'class_character',
                characters.type AS 'type_character',
                players.name AS 'name_player',
                IFNULL(SUM(items.value),0) AS last50_spent
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events ON drops.id_event = events.id
                INNER JOIN players ON characters.id_player = players.id
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY) AND characters.id = $id_character;  
            ;");
            $character = $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(items.value),0) AS total_spent
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events ON drops.id_event = events.id
                WHERE characters.id = $id_character;  
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(bosses.value),0) AS last50_earned
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY) AND id_character = $id_character
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(bosses.value),0) AS total_earned
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE id_character = $id_character
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                events.timestamp AS timestamp_last_event,
                bosses.name AS boss_last_event
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE id_character = $id_character
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $character += $query->result_array()[0];
            }
            $query = $this->db->query("SELECT
                events.timestamp AS timestamp_last_loot,
                items.name AS item_last_loot
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN events ON drops.id_event = events.id
                INNER JOIN items ON drops.id_item = items.id
                WHERE id_character = $id_character
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $character += $query->result_array()[0];
            }
            return $character;
        }

        public function list_kills($id_boss) {
            $query = $this->db->query("SELECT 
                bosses.name AS name_boss,
                COUNT(events.id_boss) AS total_kills,
                events.timestamp AS first_killed
                FROM bosses 
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = $id_boss
                ORDER BY events.timestamp ASC LIMIT 1
            ;");
            $boss = $query->result_array()[0];
            $query = $this->db->query("SELECT 
                events.timestamp AS last_killed
                FROM bosses 
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = $id_boss
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $boss += $query->result_array()[0];
            }
            return $boss;
        }
    
        public function list_items($id_boss) {
            $query = $this->db->query("SELECT 
                items.name AS name_item,
                COUNT(drops.id_item) AS number_drops
                FROM bosses
                INNER JOIN items ON bosses.id = items.id_boss
                LEFT JOIN drops ON items.id = drops.id_item
                WHERE bosses.id = $id_boss
                GROUP BY items.name
            
            ;");
            $drops = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return $drops;
        }
    }

?>
