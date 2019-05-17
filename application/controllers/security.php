<?php

    class Security extends CI_Controller
    {
        public function __construct()
        {
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
            $this->load->model('model_raid_dump');
            $this->load->model('model_discord');
            $this->load->model('model_security');
        }

        public function process_login()
        {
            $username = $this->input->post('user');
            $password = $this->input->post('password');
            $result = $this->model_security->validate_user($username, $password);
            if (!$result) {
                $this->index("<div class='badge badge-danger'>User/password incorrect</div>");
            } else {
                $this->session->set_flashdata('msg', "<div class='badge badge-success'>Welcome, " . $this->session->username . ' !</div>');
                switch ($this->session->type) {
                    case '1': {
                        redirect('admins');
                        break;
                    }
                    case '2': {
                        redirect('officers');
                        break;
                    }
                    default: {
                        redirect('members');
                    }
                }
            }
        }

        public function check_permission($type = 3)
        {
            $allowed = false;
            if (!isset($this->session->logged_in)) {
                $data['view_name'] = 'form_login';
                $data['msg'] = "<div class='badge badge-danger mx-auto'>You need to be logged in to access this page</div>";
                $this->load->view('template', $data);
            } else {
                if ($type < $this->session->type) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>You do not have permissions to access this page</div>");
                    switch ($this->session->type) {
                        case '2': {
                            redirect('officers');
                            break;
                        }
                        default: {
                            redirect('members');
                        }
                    }
                } else {
                    $allowed = true;
                }
            }
            return $allowed;
        }
    }
