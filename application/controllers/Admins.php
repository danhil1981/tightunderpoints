<?php

    include('Security.php');

    Class Admins extends Security {

        public function index($msg = null) {
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all();
            $data['items_list'] = $this->model_items->get_all();
            $data['events_list'] = $this->model_events->get_all();
            $data['drops_list'] = $this->model_drops->get_all();
            $data['attendance_list'] = $this->model_attendance->get_all();
            $data['loot_list'] = $this->model_loot->get_all();
            $data['view_name'] = 'admin_panel';
            $this->load->view('template', $data);
        }
    }

?>
