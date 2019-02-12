<?php

    include('Security.php');

    Class Events extends Security {

        public function show_insert($source = "admins") {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_event';
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $data['source'] = $source;
                $this->load->view('template', $data);
            }
        }

        public function insert() {
            if ($this->check_permission(2)) {
                $source = $this->input->post("source");
                $result_insert = $this->model_events->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Event successfully inserted</div><br/>");
                }
                $this->session->set_flashdata("table", "timers");
                if ($source == "officers") {
                    redirect('officers');
                }
                redirect('admins');
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_events->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on deletion</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Event successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "events");
                redirect('admins');
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_modify_event';
                $data['event'] = $this->model_events->get($id);
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                $result = $this->model_events->modify();
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on modification</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Event successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "events");
                redirect('admins');
            }
        }

    }

?>
