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
            $this->load->model('model_drops');
            $this->load->model('model_attendance');
            $this->load->model('model_loot');
            $this->load->model('model_officers');
        }

        public function process_login() {
            $result = $this->model_users->validate();
            if(!$result) {
                $this->index("<div class='badge badge-danger'>User/password incorrect</div><br/>");
            }
            else {
                $this->session->set_flashdata("msg","<div class='badge badge-success'>Welcome, ".$this->session->username." !</div><br/>");
                switch($this->session->type) {
                    case "Admin": {
                        redirect('admins');
                        break;
                    }
                    case "Officer": {
                        redirect('officers');
                        break;
                    }
                    default: {
                        redirect('default');
                    }
                }
            }
        }

        public function check_login() {
            $checked = false;
            if (!isset($this->session->logged_in)) {
                $this->index("<div class='badge badge-danger mx-auto'>You need to be logged in to do this!</div><br/>");
            }
            else {
                $checked = true;
            }
            return $checked;
        }

    }

?>
