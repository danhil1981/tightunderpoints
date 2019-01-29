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
                    $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                
                }
                else {
                    $data['msg'] = "<div class='badge badge-success'>Player successfully inserted</div><br/>";
                }    
                $data["table_to_show"] = "players";
                $this->admin_panel($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_players->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Player successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "players";
                $this->admin_panel($data);     
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
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Player successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "players";
                $this->admin_panel($data); 
            }

        }

    }
    
?>
