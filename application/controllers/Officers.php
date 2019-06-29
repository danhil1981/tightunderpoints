<?php

    include 'Security.php';

    class Officers extends Security
    {
        public function index()
        {
            if ($this->check_permission(2)) {
                $data['list_names_with_class'] = $this->model_characters->get_list_names_with_class();
                $data['list_types'] = $this->model_characters->get_list_types();
                $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
                $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
                $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
                $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
                $data['timers'] = $this->model_bosses->get_timers();
                $data['events'] = $this->model_events->get_list();
                $data['attendance_list'] = $this->model_attendance->get_all();
                $data['played_list'] = $this->model_attendance->get_played();
                $data['players_list'] = $this->model_players->get_all();
                $data['characters_list'] = $this->model_characters->get_all();
                $data['view_name'] = 'officer_panel';
                $this->load->view('template', $data);
            }
        }
    }
