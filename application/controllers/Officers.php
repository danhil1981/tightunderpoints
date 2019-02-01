<?php

    include('Security.php');

    Class Officers extends Security {

        public function index() {
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
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $data['events_not_in_raid'] = $this->model_events->events_not_in_raid();
                $this->load->view('template', $data);   
            }
        }

        public function insert_raid() {
            if ($this->check_login()) {
                $description= quotes_to_entities($this->input->post('description'));
                $date = $this->input->post('date');
                $result_insert = $this->model_officers->insert_raid($description, $date);
                print_r($result_insert);
                die;    
            }
        }

        public function get_events() {
            if ($this->check_login()) {
                $id_raid = $this->input->post('id_raid');
                $events_in_raid = $this->model_events->events_in_raid($id_raid);
                $this->output->set_output(json_encode($events_in_raid));
                die;
            }
        }

        public function insert_event() {
            if ($this->check_login()) {
                $time = $this->input->post('time');
                $date = $this->input->post('date');
                $id_boss = $this->input->post('id_boss');
                $id_raid = $this->input->post('id_raid');
                $result_insert = $this->model_officers->insert_event($time, $date, $id_boss, $id_raid);
                print_r($result_insert);
                die;
            }
        }

        public function get_drops() {
            if ($this->check_login()) {
                $id_event = $this->input->post("id_event");
                $id_boss = $this->model_events->get_boss($id_event);
                $boss_items = $this->model_items->get_items($id_boss);
                $this->output->set_output(json_encode($boss_items));
                die;
            }
        }

        public function get_boss() {
            if ($this->check_login()) {
                $id_event = $this->input->post("id_event");
                $id_boss = $this->model_events->get_boss($id_event);
                print_r($id_boss);
                die;
            }
        }

        public function insert_item() {
            if ($this->check_login()) {
                $id_item = $this->input->post("id_item");
                $name_item = quotes_to_entities($this->input->post("name_item"));
                $id_boss = $this->input->post("id_boss");
                $value_item = $this->input->post("value_item");
                $result_insert = $this->model_officers->insert_item($id_item, $name_item, $id_boss, $value_item);
                print_r($result_insert);
                die;
            }
        }

        public function insert_drop_loot() {
            if ($this->check_login()) {
                
                $result_insert = $this->model_officers->insert_drop_loot();    
                switch ($result_insert) {    
                    case "0": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion (drop)</div><br/>");
                    break;
                    case "1": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion (loot)</div><br/>");
                    break;
                    default: $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop and Loot Entries successfully inserted</div><br/>");
                }    
                redirect('officers');
            }
        }
        
    }
    
?>
