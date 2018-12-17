<?php 

    Class Security extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('model_players');
            $this->load->model('model_users');
            $this->load->model('model_characters');
            $this->load->model('model_bosses');
            $this->load->model('model_raids');
            $this->load->model('model_items');
            $this->load->model('model_events');
        }

        public function check_login() {
            $checked = false;
            if (!isset($this->session->logged_in)) {
                $data['msg'] = "<div class='badge badge-danger mx-auto'>You need to be logged in to do this!</div><br/>";
                $data['view_name'] = 'form_login';
                $this->load->view('template', $data);
            }
            else {
                $checked = true;
            }
            return $checked;
        }
    }
?>
