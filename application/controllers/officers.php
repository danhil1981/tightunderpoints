<?php

    include('Security.php');

    Class Officers extends Security {

        public function index() {
            if ($this->check_permission(2)) {
                $data['list_names'] = $this->model_characters->get_list_names();
                $data['list_types'] = $this->model_characters->get_list_types();
                $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
                $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
                $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
                $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
                $data['timers'] = $this->model_officers->get_timers();
                $data['events'] = $this->model_events->get_list();
                $data['attendance_list'] = $this->model_attendance->get_all();
                $data['played_list'] = $this->model_attendance->get_played();
                $data['players_list'] = $this->model_players->get_all();
                $data['characters_list'] = $this->model_characters->get_all();
                $data['view_name'] = 'officer_panel';
                $this->load->view('template', $data);
            }
        }

        public function loot($id) {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_loot';
                $data['id_character'] = $id;
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $data['events_not_in_raid'] = $this->model_events->events_not_in_raid();
                $this->load->view('template', $data);
            }
        }

        public function insert_raid() {
            if ($this->check_permission(2)) {
                $description= quotes_to_entities($this->input->post('description'));
                $date = $this->input->post('date');
                print_r($this->model_officers->insert_raid($description, $date));
                die;
            }
        }

        public function get_events() {
            if ($this->check_permission(2)) {
                $id_raid = $this->input->post('id_raid');
                $events_in_raid = $this->model_events->events_in_raid($id_raid);
                print_r(json_encode($events_in_raid));
                die;
            }
        }

        public function insert_event() {
            if ($this->check_permission(2)) {
                $result_insert = $this->model_events->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Event successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "timers");
                redirect('officers');
            }
        }

        public function insert_event_ajax() {
            if ($this->check_permission(2)) {
                $time = $this->input->post('time');
                $date = $this->input->post('date');
                $id_boss = $this->input->post('id_boss');
                $id_raid = $this->input->post('id_raid');
                print_r($this->model_officers->insert_event($time, $date, $id_boss, $id_raid));
                die;
            }
        }

        public function get_drops() {
            if ($this->check_permission(2)) {
                $id_event = $this->input->post("id_event");
                $id_boss = $this->model_events->get_boss($id_event);
                $boss_items = $this->model_items->get_items($id_boss);
                print_r(json_encode($boss_items));
                die;
            }
        }

        public function get_boss() {
            if ($this->check_permission(2)) {
                $id_event = $this->input->post("id_event");
                print_r($this->model_events->get_boss($id_event));
                die;
            }
        }

        public function insert_item() {
            if ($this->check_permission(2)) {
                $id_item = $this->input->post("id_item");
                $name_item = quotes_to_entities($this->input->post("name_item"));
                $id_boss = $this->input->post("id_boss");
                $value_item = $this->input->post("value_item");
                print_r($this->model_officers->insert_item($id_item, $name_item, $id_boss, $value_item));
                die;
            }
        }

        public function insert_drop_loot() {
            if ($this->check_permission(2)) {
                $result_insert = $this->model_officers->insert_drop_loot();
                switch ($result_insert) {
                    case "0": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error (drop)</div><br/>");
                    break;
                    case "1": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error (loot)</div><br/>");
                    break;
                    default: $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop and Loot Entries successfully created</div><br/>");
                    $this->model_discord->loot_update();
                }
                $this->session->set_flashdata("table", "points");
                redirect('officers');
            }
        }

        public function get_winner() {
            if ($this->check_permission(2)) {
                print_r($this->model_officers->get_winner());
                die;
            }
        }

        public function show_insert_attendance($id) {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_attendance';
                $data['id_event'] = $id;
                $data['events'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $this->load->view('template', $data);
            }
        }

        public function confirm_attendance() {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_confirm_insert_attendance';
                $data['id_event'] = $this->input->post("id_event");
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['list_types'] = $this->model_characters->get_list_types();
                $list_mains = $this->model_characters->get_list_mains();
                if (($_FILES['upload_characters']['error'] == 4)) {
                    $list_characters = explode(',',$this->input->post("list_characters"));
                    $data['list_characters'] = $list_characters;
                }
                else {
                    $result_upload = $this->model_raid_dump->upload($this->input->post("id_event"));
                    if (!$result_upload) {
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on upload</div><br/>");
                        $this->session->set_flashdata("table", "attendance");
                        redirect('officers');
                    }
                    else {
                        $validated_raid_dump = $this->model_raid_dump->validate($this->upload->data('file_name'));
                        if (!$validated_raid_dump) {
                            $this->session->set_flashdata("msg","<div class='badge badge-danger'>Incorrect file format</div><br/>");
                            $this->session->set_flashdata("table", "attendance");
                            redirect('officers');
                        }
                        else {
                            $list_characters = $this->model_raid_dump->process($this->upload->data('file_name'));
                            $data['list_characters'] = $list_characters;
                            unlink('./assets/uploads/raid_dumps/'.$this->upload->data('file_name'));
                        }   
                    }
                }
                foreach ($list_characters as $value) {
                    unset($list_mains[$value]);
                }
                $data['list_mains'] = $list_mains;
                $this->load->view('template', $data);
            }
        }

        public function insert_attendance() {
            if ($this->check_permission(2)) {
                $result_insert = $this->model_attendance->officer_insert();
                switch ($result_insert) {
                    case "0": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error: Missing data</div><br/>");
                    break;
                    case "1": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error(s)</div><br/>");
                    break;
                    default: $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entries successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "attendance");
                redirect('officers');
            }
        }

        public function show_modify_attendance($id_event) {
            if ($this->check_permission(2)) {
                $data['id_event'] = $id_event;
                $data['events'] = $this->model_events->get_list();
                $data['view_name'] = 'form_modify_attendance';
                $data['character_names'] = $this->model_characters->get_list_names();
                $list_characters = $this->model_attendance->get_characters($id_event);
                $data['list_characters_array'] = $list_characters;
                $data['list_characters_comma'] = implode(',',array_keys($list_characters));                
                $this->load->view('template', $data);
            }
        }

        public function confirm_modify_attendance() {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_confirm_modify_attendance';
                $data['id_event'] = $this->input->post("id_event");
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['list_types'] = $this->model_characters->get_list_types();
                $list_mains = $this->model_characters->get_list_mains();
                if (($_FILES['upload_characters']['error'] == 4)) {
                    $list_characters = explode(',',$this->input->post("list_characters"));
                    $data['list_characters'] = $list_characters;
                }
                else {
                    $result_upload = $this->model_raid_dump->upload($this->input->post("id_event"));
                    if (!$result_upload) {
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on upload</div><br/>");
                        $this->session->set_flashdata("table", "attendance");
                        redirect('officers');
                    }
                    else {
                        $validated_raid_dump = $this->model_raid_dump->validate($this->upload->data('file_name'));
                        if (!$validated_raid_dump) {
                            $this->session->set_flashdata("msg","<div class='badge badge-danger'>Incorrect file format</div><br/>");
                            $this->session->set_flashdata("table", "attendance");
                            redirect('officers');
                        }
                        else {
                            $list_characters = $this->model_raid_dump->process($this->upload->data('file_name'));
                            $data['list_characters'] = $list_characters;
                            unlink('./assets/uploads/raid_dumps/'.$this->upload->data('file_name'));
                        }   
                    }
                }
                foreach ($list_characters as $value) {
                    unset($list_mains[$value]);
                }
                $data['list_mains'] = $list_mains;
                $this->load->view('template', $data);
            }
        }

        public function modify_attendance() {
            if ($this->check_permission(2)) {
                $result_modify = $this->model_attendance->officer_modify();
                switch ($result_modify) {
                    case "0": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error: Missing data</div><br/>");
                    break;
                    case "1": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error(s)</div><br/>");
                    break;
                    default: $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entries successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "attendance");
                redirect('officers');
            }
        }

    }

?>
