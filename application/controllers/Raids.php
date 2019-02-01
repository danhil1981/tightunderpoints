<?php

    include('Security.php');

    Class Raids extends Security {

        public function show_insert() {
            if ($this->check_login()) {
                $data['view_name'] = 'form_insert_raid';
                $this->load->view('template', $data);
            }
        }

        public function insert() {
            if ($this->check_login()) {
                $result_insert = $this->model_raids->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Raid successfully inserted</div><br/>");
                }
                $this->session->set_flashdata("table", "raids");
                redirect('admins');
            }
        }

        public function delete($id) {
            if ($this->check_login()) {
                $result = $this->model_raids->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on deletion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Raid successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "raids");
                redirect('admins');
            }
        }

        public function show_modify($id) {
            if ($this->check_login()) {
                $data['view_name'] = 'form_modify_raid';
                $data['raid'] = $this->model_raids->get($id);
                $this->load->view('template', $data);
            }
        }

        public function modify() {
            if ($this->check_login()) {
                $result = $this->model_raids->modify();
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on modification</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Raid successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "raids");
                redirect('admins');
            }
        }

    }

?>
