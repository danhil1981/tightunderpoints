<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_members extends CI_Model {

        public function get_winner() {
            $comparing = $this->input->post("comparing");
            $max_id = 0;
            $max_points = -32000;
            $max_type = 3;
            $multiples = array();
            for ($i = 0; $i < count($comparing); $i=$i+3) {
                if ($comparing[$i + 2] < $max_type) {
                    $max_id = $comparing[$i];
                    $max_points = $comparing[$i + 1];
                    $max_type = $comparing[$i + 2];
                }
                else {
                    if ($comparing[$i + 2] == $max_type) {
                        if ($comparing[$i + 1] > $max_points) {
                            $multiples = array();
                            $max_id = $comparing[$i];
                            $max_points = $comparing[$i + 1];
                        }
                        if ($comparing[$i + 1] == $max_points) {
                            if (!in_array($max_id, $multiples)) {
                                array_push($multiples, $max_id);
                            }
                            array_push($multiples, $comparing[$i]); 
                        }
                    }
                }
            }
            if (empty($multiples)) {
                $query = $this->db->query("SELECT name FROM characters WHERE id = $max_id;");
                $names = implode($query->result_array()[0]);
            }
            else {
                foreach ($multiples as $i => $value) {
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

    }

?>
