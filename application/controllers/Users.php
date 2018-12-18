<?php

    include('Security.php');

    Class Users extends Security {

        public function index($msg = null) {

            $data['view_name'] = 'form_login';
            if ($msg != null) $data['msg'] = $msg;
            $this->load->view('template', $data);

        }

        public function process_login() {

            $this->load->model('model_users');
            $result = $this->model_users->validate();            
            if(!$result) {
                $this->index("<div class='badge badge-danger'>User/password incorrect</div><br/>");
            }
            else {               
                $data["table_to_show"] = "users";
                $data['msg'] = "<div class='badge badge-success'>Welcome, ".$this->session->username." !</div><br/>";
                $this->load_view('template', $data);
            }

        }

        public function admin_panel() {

            $data["table_to_show"] = "users";
            $this->load_view('template', $data);

        }

        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_user';
                $this->load->view('template', $data);
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                    $result_insert = $this->model_users->insert();    
                    if ($result_insert == 0) {    
                        $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                    
                    }    
                    else {    
                        $data['msg'] = "<div class='badge badge-success'>User successfully inserted</div><br/>";    
                    }    
                $data["table_to_show"] = "users";
                $this->load_view($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_users->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>User successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "users";
                $this->load_view($data);
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_user';
                $data['user'] = $this->model_users->get($id);
                $this->load->view('template', $data);
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_users->modify();    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>User successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "users";
                $this->load_view($data); 
            }

        }
        
    }
    
?>
