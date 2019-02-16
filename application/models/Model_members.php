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
