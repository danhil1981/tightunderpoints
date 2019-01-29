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

        public function admin_panel($data) {
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all();
            $data['items_list'] = $this->model_items->get_all();
            $data['events_list'] = $this->model_events->get_all();
            $data['drops_list'] = $this->model_drops->get_all();
            $data['attendance_list'] = $this->model_attendance->get_all();
            $data['loot_list'] = $this->model_loot->get_all();
            $data['view_name'] = 'admin_panel';
            $this->load->view('template', $data);

        }

        public function officer_panel($data) {
            $data['list_names'] = $this->model_characters->get_list_names();
            $data['list_types'] = $this->model_characters->get_list_types();
            $data['list_total_earned'] = $this->model_characters->get_list_total_earned();
            $data['list_last50_earned'] = $this->model_characters->get_list_last50_earned();
            $data['list_total_spent'] = $this->model_characters->get_list_total_spent();
            $data['list_last50_spent'] = $this->model_characters->get_list_last50_spent();
            $data['view_name'] = 'officer_panel';
            $this->load->view('template',$data);
        }

        public function process_login() {

            $result = $this->model_users->validate();            
            if(!$result) {
                $this->index("<div class='badge badge-danger'>User/password incorrect</div><br/>");
            }
            else {
                $data['msg'] = "<div class='badge badge-success'>Welcome, ".$this->session->username." !</div><br/>";
                switch($this->session->type) {
                    case "Admin": {
                        $this->admin_panel($data);
                        break;
                    }
                    case "Officer": {
                        $this->officer_panel($data);
                        break;
                    }
                    default: {
                        $this->user_panel($data);
                    }
                }         
                
            }

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
