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
                    $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                
                }
                else {
                    $data['msg'] = "<div class='badge badge-success'>Raid successfully inserted</div><br/>";
                }    
                $data["table_to_show"] = "raids";
                $this->admin_panel($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_raids->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Raid successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "raids";
                $this->admin_panel($data);     
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
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Raid successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "raids";
                $this->admin_panel($data); 
            }

        }
        
    }
    
?>
