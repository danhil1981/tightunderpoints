<?php

    include('Security.php');

    Class Officers extends Security {

        public function index($msg = null) {
            $data['character_names'] = $this->model_characters->get_list();
            $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
            $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
            $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
            $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
            $data['view_name'] = 'officer_panel';
            $this->load->view('template', $data);

        }

        public function point_list() {

            if ($this->check_login()) {
                $data['character_names'] = $this->model_characters->get_list();
                $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
                $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
                $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
                $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
                $data['view_name'] = 'officer_panel';
                $data["table_to_show"] = "point_list";
                $this->load_view($data);
            }

        }
        
    }
    
?>
