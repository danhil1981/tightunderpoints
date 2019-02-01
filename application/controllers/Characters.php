<?php

    include('Security.php');

    Class Characters extends Security {

        public function show_insert() {
            if ($this->check_login()) {
                $data['view_name'] = 'form_insert_character';
                $data['player_names'] = $this->model_players->get_list();
                $this->load->view('template', $data);
            }
        }

        public function insert() {
            if ($this->check_login()) {
                $result_insert = $this->model_characters->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Character successfully inserted</div><br/>");
                }
                $this->session->set_flashdata("table", "characters");
                redirect('admins');
            }
        }

        public function delete($id) {
            if ($this->check_login()) {
                $result = $this->model_characters->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on deletion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Character successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "characters");
                redirect('admins');
            }
        }

        public function show_modify($id) {
            if ($this->check_login()) {
                $data['view_name'] = 'form_modify_character';
                $data['character'] = $this->model_characters->get($id);
                $data['player_names'] = $this->model_players->get_list();
                $this->load->view('template', $data);
            }
        }

        public function modify() {
            if ($this->check_login()) {
                $result = $this->model_characters->modify();
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on modification</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Character successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "characters");
                redirect('admins');
            }
        }

    }

?>
