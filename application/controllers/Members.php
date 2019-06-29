<?php

    include 'Security.php';

    class Members extends Security
    {
        public function index()
        {
            if ($this->check_permission()) {
                $data['list_names_with_class'] = $this->model_characters->get_list_names_with_class();
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
                $data['drop_list'] = $this->model_drops->get_drops_items();
                $data['view_name'] = 'member_panel';
                $this->load->view('template', $data);
            }
        }
    }
