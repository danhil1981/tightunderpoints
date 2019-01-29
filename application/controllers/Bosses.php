<?php

    include('Security.php');

    Class Bosses extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {
                $data['view_name'] = 'form_insert_boss';
                $this->load->view('template', $data);
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                $result_insert = $this->model_bosses->insert();
                if ($result_insert == 0) {
                    $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";
                }
                else {
                    $data['msg'] = "<div class='badge badge-success'>Boss successfully inserted</div><br/>";
                }    
                $data["table_to_show"] = "bosses";
                $this->admin_panel($data);
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_bosses->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Boss successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "bosses";
                $this->admin_panel($data);     
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_boss';
                $data['boss'] = $this->model_bosses->get($id);
                $this->load->view('template', $data);
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_bosses->modify();    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Boss successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "bosses";
                $this->admin_panel($data); 
            }

        }

    }

?>
