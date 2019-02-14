<?php

    include('Security.php');

    Class Items extends Security {

        public function show_insert() {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_insert_item';
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
            }
        }

        public function insert() {
            if ($this->check_permission(1)) {
                $result_insert = $this->model_items->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Item successfully inserted</div><br/>");
                }
                $this->session->set_flashdata("table", "items");
                redirect('admins');
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_items->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Item successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "items");
                redirect('admins');
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_modify_item';
                $data['item'] = $this->model_items->get($id);
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                $result = $this->model_items->modify();
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Item successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "items");
                redirect('admins');
            }
        }

    }

?>
