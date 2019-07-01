<?php

    class Model_bosses extends CI_Model
    {
        public function get($id)
        {
            $query = $this->db->query("SELECT
                * FROM bosses
                WHERE id = '$id'
            ;");
            return $query->result_array()[0];
        }

        public function get_all()
        {
            $query = $this->db->query('SELECT
                * FROM bosses
            ;');
            $bosses = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $bosses[] = $row;
                }
            }
            return $bosses;
        }

        public function get_list()
        {
            $query = $this->db->query('SELECT
                id AS id_boss,
                name AS name_boss
                FROM bosses
            ;');
            $bosses = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $bosses[] = $row;
                }
            }
            return array_column($bosses, 'name_boss', 'id_boss');
        }

        public function get_name($id)
        {
            $query = $this->db->query("SELECT
                name
                FROM bosses
                WHERE id = '$id'
            ;");
            return $query->row()->name;
        }

        public function get_list_kills($id_boss)
        {
            $query = $this->db->query("SELECT
                bosses.name AS name_boss,
                COUNT(events.id_boss) AS total_kills,
                events.timestamp AS first_killed
                FROM bosses
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = '$id_boss'
                ORDER BY events.timestamp ASC LIMIT 1
            ;");
            $boss = $query->result_array()[0];
            $query = $this->db->query("SELECT
                events.timestamp AS last_killed
                FROM bosses
                LEFT JOIN events ON bosses.id = events.id_boss
                WHERE bosses.id = '$id_boss'
                ORDER BY events.timestamp DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $boss += $query->result_array()[0];
            }
            return $boss;
        }

        public function get_list_items($id_boss)
        {
            $query = $this->db->query("SELECT
                items.name AS name_item,
                COUNT(drops.id_item) AS number_drops
                FROM bosses
                INNER JOIN items ON bosses.id = items.id_boss
                LEFT JOIN drops ON items.id = drops.id_item
                WHERE bosses.id = '$id_boss'
                GROUP BY items.name
            ;");
            $drops = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return $drops;
        }

        public function get_timers()
        {
            $query = $this->db->query("SELECT
                bosses.id AS 'id_boss',
                bosses.name AS 'name_boss',
                events.timestamp AS 'last_killed',
                ADDTIME(ADDTIME(events.timestamp, bosses.respawn),-bosses.variance) AS 'start_window',
                ADDTIME(ADDTIME(events.timestamp, bosses.respawn),bosses.variance) AS 'end_window'
                FROM bosses
                INNER JOIN events ON bosses.id = events.id_boss
                WHERE events.timestamp =
                    (SELECT MAX(events.timestamp) FROM events WHERE bosses.id = events.id_boss)
                    AND
                    (ADDTIME(ADDTIME(ADDTIME(events.timestamp, bosses.respawn),bosses.variance), '10 0:00:00')) > NOW()
            ;");
            $timers = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $timers[] = $row;
                }
            }
            return $timers;
        }

        public function insert($name, $respawn, $variance, $value)
        {
            $this->db->query("INSERT
                INTO bosses (name, respawn, variance, value)
                VALUES ('$name', '$respawn', '$variance', '$value')
            ;");
            return $this->db->affected_rows();
        }

        public function delete($id)
        {
            $this->db->query("DELETE
                FROM bosses
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $name, $respawn, $variance, $value)
        {
            $this->db->query("UPDATE
                bosses SET
                name = '$name',
                respawn = '$respawn',
                variance = '$variance',
                value = '$value'
                WHERE id = '$id';");
            return $this->db->affected_rows();
        }
    }
