<?php

    class Model_characters extends CI_Model
    {
        public function get($id)
        {
            $query = $this->db->query("SELECT
                * FROM characters
                WHERE id = '$id'
            ;");
            return $query->result_array()[0];
        }

        public function get_all()
        {
            $query = $this->db->query("SELECT
                characters.id, characters.name, characters.level, characters.class, characters.type, characters.id_player,
                players.name AS name_player
                FROM characters
                LEFT JOIN players ON characters.id_player = players.id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return $characters;
        }

        public function get_name($id)
        {
            $query = $this->db->query("SELECT
                name
                FROM characters
                WHERE id = '$id'
            ;");
            return $query->result_array()[0];
        }

        public function get_list_names()
        {
            $query = $this->db->query("SELECT
                id AS id_character,
                name AS name_character
                FROM characters
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, "name_character", "id_character");
        }

        public function get_list_mains()
        {
            $query = $this->db->query("SELECT
                id AS id_character,
                name AS name_character
                FROM characters
                WHERE type = 1
                ORDER BY name ASC
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, "name_character", "id_character");
        }

        public function get_list_total_earned()
        {
            $query = $this->db->query("SELECT
                characters.id AS id_character,
                IFNULL(SUM(bosses.value),0) AS total_earned
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
            return array_column($list_total_earned, "total_earned", "id_character");
        }

        public function get_list_last50_earned()
        {
            $query = $this->db->query("SELECT
	            characters.id AS id_character,
                0 AS last50_earned
                FROM characters
                ORDER BY id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            $characters = array_column($characters, "last50_earned", "id_character");
            $query = $this->db->query("SELECT
                characters.id AS id_character,
                IFNULL(SUM(bosses.value),0) AS last50_earned
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
            $characters_with_points = array_column($characters_with_points, "last50_earned", "id_character");
            $list_last50_earned = array();
            foreach ($characters as $i => $id[0]) {
                if (isset($characters_with_points[$i])) {
                    $list_last50_earned[$i] = $characters[$i] + $characters_with_points[$i];
                } else {
                    $list_last50_earned[$i] = 0;
                }
            }
            return $list_last50_earned;
        }

        public function get_list_total_spent()
        {
            $query = $this->db->query("SELECT
                characters.id AS id_character,
                IFNULL(SUM(items.value),0) AS total_spent
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
            return array_column($characters, "total_spent", "id_character");
        }

        public function get_list_last50_spent()
        {
            $query = $this->db->query("SELECT
	            characters.id as id_character,
                0 AS last50_spent
                FROM characters
                ORDER BY id
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            $characters = array_column($characters, "last50_spent", "id_character");
            $query = $this->db->query("SELECT
                characters.id AS id_character,
                IFNULL(SUM(items.value),0) AS last50_spent
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
            $characters_with_points = array_column($characters_with_points, "last50_spent", "id_character");
            $list_last50_spent = array();
            foreach ($characters as $i => $id[0]) {
                if (isset($characters_with_points[$i])) {
                    $list_last50_spent[$i] = $characters[$i] + $characters_with_points[$i];
                } else {
                    $list_last50_spent[$i] = 0;
                }
            }
            return $list_last50_spent;
        }

        public function get_list_types()
        {
            $query = $this->db->query("SELECT
                id AS id_character,
                type AS type_character
                FROM characters
            ;");
            $characters = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $characters[] = $row;
                }
            }
            return array_column($characters, "type_character", "id_character");
        }

        public function get_winner($comparing)
        {
            $max_points = -32000;
            $max_type = 3;
            for ($i = 0; $i < count($comparing); $i=$i+3) {
                $id = $comparing[$i];
                $points = $comparing[$i+1];
                $type = $comparing[$i+2];
                if ($type < $max_type) {
                    $max_id = $id;
                    $max_points = $points;
                    $max_type = $type;
                    $multiples = array();
                    array_push($multiples, $id);
                } else {
                    if ($type == $max_type) {
                        if ($points > $max_points) {
                            $max_points = $points;
                            $multiples = array();
                            array_push($multiples, $id);
                        } elseif ($points == $max_points) {
                            array_push($multiples, $id);
                        }
                    }
                }
            }
            if (count($multiples) == 1) {
                $query = $this->db->query("SELECT
                    id, name
                    FROM characters
                    WHERE id = '$multiples[0]'
                ;");
                $winner = implode($query->result_array()[0]);
            } else {
                $winner = $multiples[array_rand($multiples)];
                $query = $this->db->query("SELECT
                    id, name
                    FROM characters
                    WHERE id = '$winner'
                ;");
                $winner = implode($query->result_array()[0]);
            }
            return $winner;
        }

        public function get_max($comparing)
        {
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
                } else {
                    if ($type == $max_type) {
                        if ($points > $max_points) {
                            $max_points = $points;
                            $multiples = array();
                            array_push($multiples, $id);
                        } elseif ($points == $max_points) {
                            array_push($multiples, $id);
                        }
                    }
                }
            }
            if (count($multiples) == 1) {
                $query = $this->db->query("SELECT
                    name
                    FROM characters
                    WHERE id = '$multiples[0]'
                ;");
                $names = implode($query->result_array()[0]);
            } else {
                foreach ($multiples as $value) {
                    $query = $this->db->query("SELECT
                        name
                        FROM characters
                        WHERE id = '$value'
                    ;");
                    if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                            $name[] = $row;
                        }
                    }
                }
                $names = implode(', ', array_column($name, "name"));
            }
            return $names;
        }

        public function get_character_info($id_character)
        {
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
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY)
                AND characters.id = '$id_character'
            ;");
            $character = $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(items.value),0) AS total_spent
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events ON drops.id_event = events.id
                WHERE characters.id = '$id_character'
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(bosses.value),0) AS last50_earned
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE events.timestamp >= DATE_SUB(NOW(), INTERVAL 50 DAY)
                AND characters.id = '$id_character'
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                IFNULL(SUM(bosses.value),0) AS total_earned
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE characters.id = '$id_character'
            ;");
            $character += $query->result_array()[0];
            $query = $this->db->query("SELECT
                events.timestamp AS timestamp_last_event,
                bosses.name AS boss_last_event
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_points
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE characters.id = '$id_character'
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $character += $query->result_array()[0];
            }
            $query = $this->db->query("SELECT
                events.timestamp AS timestamp_last_botted,
                bosses.name AS boss_last_event
                FROM characters
                INNER JOIN attendance ON characters.id = attendance.id_character
                INNER JOIN events ON attendance.id_event = events.id
                INNER JOIN bosses ON events.id_boss = bosses.id
                WHERE characters.id = '$id_character'
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
                WHERE characters.id = '$id_character'
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $character += $query->result_array()[0];
            }
            return $character;
        }

        public function insert($name, $level, $class, $type, $id_player)
        {
            $this->db->query("INSERT
                INTO characters (name, level, class, type, id_player)
                VALUES ('$name', '$level', '$class', '$type', '$id_player')
            ;");
            return $this->db->affected_rows();
        }

        public function delete($id)
        {
            $this->db->query("DELETE
                FROM characters
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $name, $level, $class, $type, $id_player)
        {
            $this->db->query("UPDATE
                characters SET
                name = '$name',
                level = '$level',
                type = '$type',
                id_player = '$id_player'
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }
    }
