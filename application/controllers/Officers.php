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
            $data['timers'] = $this->model_officers->get_timers();
            $data['view_name'] = 'officer_panel';
            $this->load->view('template', $data);

        }

        public function loot($id) {
            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_loot_entry_officers';
                $data['id_character'] = $id;
                $data['name_character'] = $this->model_characters->get_name($id);
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $data['events_not_in_raid'] = $this->model_events->events_not_in_raid();
                $this->load->view('template', $data);   
            }
        }

        public function insert_raid() {
            if ($this->check_login()) {
                $description= $this->input->post('description');
                $date = $this->input->post('date');
                $result_insert = $this->model_officers->insert_raid($description, $date);
                print_r($result_insert);die;   
            }
        }

        public function get_events() {
            if ($this->check_login()) {
                $id_raid = $this->input->post('id_raid');
                $events_in_raid = $this->model_events->events_in_raid($id_raid);
                $this->output->set_output(json_encode($events_in_raid));
            }
        }

        public function insert_event() {
            if ($this->check_login()) {
                $time = $this->input->post('time');
                $date = $this->input->post('date');
                $id_boss = $this->input->post('id_boss');
                $id_raid = $this->input->post('id_raid');
                $result_insert = $this->model_officers->insert_event($time, $date, $id_boss, $id_raid);
                print_r($result_insert);die;
            }
        }

        public function get_drops() {
            if ($this->check_login()) {
                $id_event = $this->input->post("id_event");
                $drops_in_event = $this->model_drops->drops_in_event($id_event);
                $this->output->set_output(json_encode($drops_in_event));
            }
        }
        
    }
    
?>
