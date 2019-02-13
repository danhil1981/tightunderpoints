<?php

    include('Security.php');

    Class Members extends Security {

        public function index() {
            if ($this->check_permission()) {
                $data['list_names'] = $this->model_characters->get_list_names();
                $data['list_types'] = $this->model_characters->get_list_types();
                $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
                $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
                $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
                $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
                $data['loot_list'] = $this->model_loot->get_all();
                $data['characters_list'] = $this->model_characters->get_all();
                $data['bosses_list'] = $this->model_bosses->get_all();
                $data['raids_list'] = $this->model_raids->get_all();
                $data['items_list'] = $this->model_items->get_all();
                $data['events_list'] = $this->model_events->get_all();
                $data['view_name'] = 'member_panel';
                $this->load->view('template', $data);
            }
        }

        public function get_winner() {
            if ($this->check_permission(3)) {
                $names = $this->model_members->get_winner();
                print_r($names);
                die;
            }
        }

    }

?>
