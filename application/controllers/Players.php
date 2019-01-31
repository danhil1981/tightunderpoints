<?php

    include('Security.php');

    Class Players extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_player';
                $this->load->view('template', $data);    
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                $result_insert = $this->model_players->insert();
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion</div><br/>");                
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Player successfully inserted</div><br/>");
                }    
                $this->session->set_flashdata("table", "players");
                redirect('admins');   
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_players->delete($id);    
                if ($result == 0) {    
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on deletion</div><br/>");    
                }                
                else {    
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Player successfully deleted</div><br/>");                
                }
                $this->session->set_flashdata("table", "players");
                redirect('admins');    
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_player';
                $data['player'] = $this->model_players->get($id);
                $this->load->view('template', $data);    
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_players->modify();    
                if ($result == 0) {    
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on modification</div><br/>");    
                }
                else {    
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Player successfully modified</div><br/>");    
                }
                $this->session->set_flashdata("table", "players");
                redirect('admins');
            }

        }

    }
    
?>
