<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Items extends CI_Model {

        public function get_all() {
            $query = $this->db->query("SELECT items.id, items.name, items.id_boss, items.value, bosses.name as name_boss FROM items LEFT JOIN bosses ON items.id_boss = bosses.id;");
            $items = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $items[] = $row;
                }
            }
            return $items;
        }
    
        public function get($id) {
            $query = $this->db->query("SELECT * FROM items WHERE id = $id;");
            $item = $query->result_array()[0];
    
            return $item;
        }
    
        public function delete($id) {
    
            $this->db->query("DELETE FROM items WHERE id = $id ;");
    
            return $this->db->affected_rows();            
        }
    
    
        public function insert() {
            $id = $this->input->post('id');
            $name = quotes_to_entities($this->input->post('name'));
            $id_boss = $this->input->post('id_boss');
            $value = $this->input->post('value');
    
            $this->db->query("INSERT INTO items (id, name, id_boss, value) VALUES ('$id', '$name', '$id_boss', '$value');");
    
            return $this->db->affected_rows(); 
        }
    
        public function modify() {
            $id = $this->input->post('id');
            $name = quotes_to_entities($this->input->post('name'));
            $id_boss = $this->input->post('id_boss');
            $value = $this->input->post('value');
    
            $this->db->query("UPDATE items SET id = '$id', name = '$name', id_boss = '$id_boss', value = '$value' WHERE id = $id;");
    
            return $this->db->affected_rows();
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
    }

?>
