<?php

    class Model_raid_dump extends CI_Model
    {
        public function upload($id_event)
        {
            $config['upload_path'] = './assets/uploads/raid_dumps/';
            $config['allowed_types'] = 'txt';
            $config['max_size'] = 100;
            $config['file_name'] = $id_event;
            $config['overwrite'] = true;
            $this->upload->initialize($config);
            return $this->upload->do_upload('upload_characters');
        }

        public function validate($raid_dump)
        {
            $validated = true;
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

        public function process($raid_dump)
        {
            $info = [];
            $rows = explode("\n", $raid_dump);
            foreach ($rows as $row => $data) {
                if (!empty($data)) {
                    $row_data = explode("\t", $data);
                    $info[$row]['id_group'] = $row_data[0];
                    $info[$row]['name_character'] = $row_data[1];
                }
            }
            $list_characters = [];
            foreach ($info as $data) {
                if ($data['id_group'] != '0') {
                    $name = $data['name_character'];
                    $query = $this->db->query("SELECT
                        id
                        FROM characters
                        WHERE name = '$name'
                    ;");
                    if (count($query->result_array()) != 0) {
                        $id_character = $query->result_array()[0]['id'];
                        array_push($list_characters, $id_character);
                    }
                }
            }
            return $list_characters;
        }
    }
