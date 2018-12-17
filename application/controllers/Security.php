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
<<<<<<< HEAD
        }

=======
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all();
            $data['items_list'] = $this->model_items->get_all();
            $data['events_list'] = $this->model_events->get_all();
        }



>>>>>>> 63be1d54bc31d4e7761077c5cd8efb7580057357
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
