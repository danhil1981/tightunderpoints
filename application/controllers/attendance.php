<?php

    include('Security.php');

    Class Attendance extends Security {

        public function show_insert() {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_insert_attendance_entry';
                $data['event_names'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['main_names'] = $this->model_characters->get_list_mains();
                $this->load->view('template', $data);
            }
        }

        public function insert() {
            if ($this->check_permission(1)) {
                $id_event = $this->input->post("id_event");
                $id_character = $this->input->post("id_character");
                $id_points = $this->input->post("id_points");
                $result_insert = $this->model_attendance->insert($id_event, $id_character, $id_points);
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entry successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "attendance");
                redirect('admins');
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_attendance->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entry successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "attendance");
                redirect('admins');
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_modify_attendance_entry';
                $data['event_names'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['main_names'] = $this->model_characters->get_list_mains();
                $data['attendance_entry'] = $this->model_attendance->get($id);
                $this->load->view('template', $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                $id = $this->input->post('id');
                $id_event = $this->input->post("id_event");
                $id_character = $this->input->post("id_character");
                $id_points = $this->input->post("id_points");
                $result = $this->model_attendance->modify($id, $id_event, $id_character, $id_points);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entry successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "attendance");
                redirect('admins');
            }
        }

        public function show_officer_insert($id) {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_attendance';
                $data['id_event'] = $id;
                $data['events'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $this->load->view('template', $data);
            }
        }

        public function show_confirm_officer_insert() {
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
                        $raid_dump = file_get_contents('./assets/uploads/raid_dumps/'.$this->upload->data('file_name'));
                        if (!$this->model_raid_dump->validate($raid_dump)) {
                            $this->session->set_flashdata("msg","<div class='badge badge-danger'>Incorrect file format</div><br/>");
                            $this->session->set_flashdata("table", "attendance");
                            redirect('officers');
                        }
                        else {
                            $list_characters = $this->model_raid_dump->process($raid_dump);
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

        public function officer_insert() {
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

        public function show_officer_modify($id_event) {
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

        public function show_confirm_officer_modify() {
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

        public function officer_modify() {
            if ($this->check_permission(2)) {
                $id_event = $this->input->post("id_event");
                $result_modify = $this->model_attendance->officer_modify($id_event);
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
