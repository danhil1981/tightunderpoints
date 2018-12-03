<?php
    include('Security.php');

    Class Users extends Security {

        public function __construct() {
            parent::__construct();
            $this->load->model('model_players');
            $this->load->model('model_users');
            $this->load->model('model_characters');
            $this->load->model('model_bosses');
            $this->load->model('model_raids');
        }

        public function load_view($data = NULL) {
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all(); 
            $data['view_name'] = 'admin_panel';
            $data["table_to_show"] = "users";
            $this->load->view('template', $data);
        }

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
                $data['users_list'] = $this->model_users->get_all();
                $data['players_list'] = $this->model_players->get_all();
                $data['characters_list'] = $this->model_characters->get_all();
                $data['bosses_list'] = $this->model_bosses->get_all();
                $data['raids_list'] = $this->model_raids->get_all();
                $data['view_name'] = 'admin_panel';
                $data['msg'] = "<div class='badge badge-success'>Welcome, ".$this->session->username." !</div><br/>";
                $this->load->view('template', $data);
            }
        }

        public function admin_panel() {
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all();
            $data['view_name'] = 'admin_panel';
            $this->load->view('template', $data);
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
                
                $this->load_view($data); 
            }
        }
    }
    
?>
