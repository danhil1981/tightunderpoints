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
                $this->index("<div class='error'>User/password incorrect</div><br/>");
            }
            else {
                $this->load->model('model_players');                 
                $data['players_list'] = $this->model_players->get_all();
                $data['view_name'] = 'admin_panel';
                $data['msg'] = "<div class='success'>Welcome, ".$this->session->username." !</div><br/>";
                $this->load->view('template', $data);
            }
        }

        public function admin_panel() {
            $this->load->model('model_players'); 
            $data['view_name'] = 'admin_panel';
            $data['players_list'] = $this->model_players->get_all();
            $this->load->view('template', $data);
        }
    }
    
?>
