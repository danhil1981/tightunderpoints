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
            $this->load->model('model_raid_dump');
        }

        public function process_login() {
            $result = $this->model_users->validate();
            if(!$result) {
                $this->index("<div class='badge badge-danger'>User/password incorrect</div><br/>");
            }
            else {
                $this->session->set_flashdata("msg","<div class='badge badge-success'>Welcome, ".$this->session->username." !</div><br/>");
                switch($this->session->type) {
                    case "1": {
                        redirect('admins');
                        break;
                    }
                    case "2": {
                        redirect('officers');
                        break;
                    }
                    default: {
                        redirect('members');
                    }
                }
            }
        }

        public function check_permission($type = 3) {
            $allowed = false;
            if (!isset($this->session->logged_in)) {
                $this->index("<div class='badge badge-danger mx-auto'>You need to be logged in to do this!</div><br/>");
            }
            else {
                if ($type < $this->session->type) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>You are not allowed to do this!</div><br/>");
                    switch($this->session->type) {
                        case "2": {
                            redirect('officers');
                            break;
                        }
                        default: {
                            redirect('members');
                        }
                    }
                }
                else {
                    $allowed = true;
                }
                
            }
            return $allowed;
        }

    }

?>
