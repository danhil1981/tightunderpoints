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
                    $result_insert = $this->model_attendance->insert();
                    if ($result_insert == 0) {
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                    }
                    else {
                        $this->session->set_flashdata("msg","<div class='badge badge-success'>Attendance Entry successfully inserted</div><br/>");
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
                $result = $this->model_attendance->modify();
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

    }

?>
