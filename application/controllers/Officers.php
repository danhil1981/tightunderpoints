<?php

    include('Security.php');

    Class Officers extends Security {

        public function index($msg = null) {
            $data['list_names'] = $this->model_characters->get_list_names();
            $data['list_types'] = $this->model_characters->get_list_types();
            $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
            $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
            $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
            $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
            $data['view_name'] = 'officer_panel';
            $this->load->view('template', $data);

        }

        public function point_list() {

            if ($this->check_login()) {
                $data['list_names'] = $this->model_characters->get_list_names();
                $data['list_types'] = $this->model_characters->get_list_types();
                $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
                $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
                $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
                $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
                $data['view_name'] = 'officer_panel';
                $data["table_to_show"] = "point_list";
                $this->load_view($data);
            }

        }

        public function loot($id) {
            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_loot_entry_officers';
                $data['id_character'] = $id;
                $data['name_character'] = $this->model_characters->get_name($id);
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $this->load->view('template', $data);   
            }
        }

        public function insert_raid($description, $date) {
            if ($this->check_login()) {
                $result_insert = $this->model_raids->insert();
                if ($result_insert == 0) {
                    $this->output->set_output("0");                
                }
                else {
                    $this->output->set_output("1");
                }    
            }
        }
        
    }
    
?>
