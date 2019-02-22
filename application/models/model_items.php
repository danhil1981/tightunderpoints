<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    Class Model_items extends CI_Model {

        public function get($id) {
            $query = $this->db->query("SELECT * FROM items WHERE id = $id;");
            return $query->result_array()[0];
        }

        public function get_all() {
            $query = $this->db->query("SELECT
                items.id, items.name, items.id_boss, items.value, bosses.name AS name_boss
                FROM items LEFT JOIN bosses ON items.id_boss = bosses.id
            ;");
            $items = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $items[] = $row;
                }
            }
            return $items;
        }

        public function get_list() {
            $query = $this->db->query("SELECT id AS id_item, name AS name_item FROM items;");
            $items = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $items[] = $row;
                }
            }
            return array_column($items, 'name_item', 'id_item');
        }

        public function get_items($id_boss) {
            $query = $this->db->query("SELECT id AS id_item, name AS name_item FROM items WHERE id_boss = $id_boss;");
            $items = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $items[] = $row;
                }
            }
            return array_column($items, 'name_item', 'id_item');
        }

        public function get_item_info($id_item) {
            $query = $this->db->query("SELECT
	            items.name AS name_item
                FROM items
                WHERE id = $id_item
            ;");
            $item = $query->result_array()[0];
            $query = $this->db->query("SELECT
	            COUNT(items.id) AS number_drops
                FROM items
                INNER JOIN drops on items.id = drops.id_item
                WHERE items.id = $id_item
            ;");
            $item += $query->result_array()[0];
            $query = $this->db->query("SELECT
                characters.name AS name_first_looter,
                events.timestamp AS timestamp_first_loot
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events ON drops.id_event = events.id
                WHERE items.id = $id_item
                ORDER BY drops.id ASC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $item += $query->result_array()[0];
            }
            $query = $this->db->query("SELECT
                characters.name AS name_last_looter,
                events.timestamp AS timestamp_last_loot
                FROM characters
                INNER JOIN loot ON characters.id = loot.id_character
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN items ON drops.id_item = items.id
                INNER JOIN events ON drops.id_event = events.id
                WHERE items.id = $id_item
                ORDER BY drops.id DESC LIMIT 1
            ;");
            if (isset($query->result_array()[0])) {
                $item += $query->result_array()[0];
            }
            return $item;
        }

        public function insert($id, $name, $id_boss, $value) {
            $this->db->query("INSERT INTO items (id, name, id_boss, value) VALUES ('$id', '$name', '$id_boss', '$value');");
            return $this->db->affected_rows();
        }

        public function delete($id) {
            $this->db->query("DELETE FROM items WHERE id = $id ;");
            return $this->db->affected_rows();
        }

        public function modify($id, $name, $id_boss, $value) {
            $this->db->query("UPDATE items SET id = '$id', name = '$name', id_boss = '$id_boss', value = '$value' WHERE id = $id;");
            return $this->db->affected_rows();
        }

    }

?>
