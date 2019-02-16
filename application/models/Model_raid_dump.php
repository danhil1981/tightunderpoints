<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_raid_dump extends CI_Model {
        
        public function upload($id_event) {
            $config['upload_path']          = './assets/uploads/raid_dumps/';
            $config['allowed_types']        = 'txt';
            $config['max_size']             = 100;
            $config['file_name']            = $id_event;
            $config['overwrite']            = TRUE;
            $this->upload->initialize($config);
            return $this->upload->do_upload('upload_characters');
        }

        public function validate($name_file) {
            $validated = true;
            $raid_dump = file_get_contents('./assets/uploads/raid_dumps/'.$name_file);
            $rows = explode("\n", $raid_dump);
            foreach ($rows as $data) {
                if (!empty($data)) {
                    $row_data = explode("\t", $data);
                    if (count($row_data) < 6) {
                        $validated = false;
                    }
                }
            }
            return $validated;
        }

        public function process($name_file) {
            $raid_dump = file_get_contents('./assets/uploads/raid_dumps/'.$name_file);
            $info = array();
            $rows = explode("\n", $raid_dump);
            foreach ($rows as $row => $data) {
                if (!empty($data)) {
                    $row_data = explode("\t", $data);
                    $info[$row]['id_group'] = $row_data[0];
                    $info[$row]['name_character'] = $row_data[1];
                }
            }
            $list_characters = array();
            foreach ($info as $data) {
                if (!in_array($data['id_group'], array('0','11','12'))) {
                    $name = $data['name_character'];
                    $query = $this->db->query("SELECT id FROM characters WHERE name = '$name';");
                    if (count($query->result_array()) != 0 ) {
                        $id_character = $query->result_array()[0]['id'];
                        array_push($list_characters, $id_character);
                    }
                }
            }
            return $list_characters; 
        }

    }

?>
