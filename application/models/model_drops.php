<?php

    class Model_drops extends CI_Model
    {
        public function get($id)
        {
            $query = $this->db->query("SELECT
                * FROM drops
                WHERE id = '$id'
            ;");
            return $query->result_array()[0];
        }

        public function get_all()
        {
            $query = $this->db->query("SELECT
                drops.id, drops.id_event, drops.id_item,
                CONCAT(events.timestamp,' - ', bosses.name) AS name_event,
                items.name AS name_item
                FROM drops
                INNER JOIN events ON drops.id_event = events.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN bosses ON events.id_boss = bosses.id
            ;");
            $drops = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return $drops;
        }

        public function get_list()
        {
            $query = $this->db->query("SELECT
                drops.id AS id_drop,
                CONCAT(events.timestamp,' - ', items.name) AS name_drop
                FROM drops
                INNER JOIN events ON drops.id_event = events.id
                INNER JOIN items ON drops.id_item = items.id
            ;");
            $drops = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops[] = $row;
                }
            }
            return array_column($drops, 'name_drop', 'id_drop');
        }

        public function get_drops_items()
        {
            $query = $this->db->query('SELECT
                drops.id AS id_drop,
                items.id AS id_item
                FROM drops
                INNER JOIN items ON drops.id_item = items.id
            ;');
            $drops_items = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $drops_items[] = $row;
                }
            }
            return array_column($drops_items, 'id_item', 'id_drop');
        }

        public function insert($id_event, $id_item)
        {
            $this->db->query("INSERT
                INTO drops (id_event, id_item)
                VALUES ('$id_event', '$id_item')
            ;");
            return $this->db->affected_rows();
        }

        public function delete($id)
        {
            $this->db->query("DELETE
                FROM drops
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $id_event, $id_item)
        {
            $this->db->query("UPDATE
                drops SET
                id_event = '$id_event',
                id_item = '$id_item'
                WHERE id = '$id'
            ;");
            return $this->db->affected_rows();
        }
    }
