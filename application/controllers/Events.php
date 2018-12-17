<?php
    include('Security.php');

    Class Events extends Security {

        public function load_view($data = NULL) {
            $data['users_list'] = $this->model_users->get_all();
            $data['players_list'] = $this->model_players->get_all();
            $data['characters_list'] = $this->model_characters->get_all();
            $data['bosses_list'] = $this->model_bosses->get_all();
            $data['raids_list'] = $this->model_raids->get_all();
            $data['items_list'] = $this->model_items->get_all();
            $data['events_list'] = $this->model_events->get_all();
            $data['view_name'] = 'admin_panel';
            $data["table_to_show"] = "events";
            $this->load->view('template', $data);
        }

        
        public function show_insert() {

            if ($this->check_login()) {
    
                $data['view_name'] = 'form_insert_event';
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
    
            }
        }

        public function insert() {

            if ($this->check_login()) {
    
                    $result_insert = $this->model_events->insert();
    
                    if ($result_insert == 0) {
    
                        $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";
                    
                    }
    
                    else {
    
                        $data['msg'] = "<div class='badge badge-success'>Event successfully inserted</div><br/>";
    
                    }    
    
                $this->load_view($data);
    
            }
        }

        public function delete($id) {

            if ($this->check_login()) {
    
                $result = $this->model_events->delete($id);
    
                if ($result == 0) {
    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";
    
                }
                
                else {
    
                    $data['msg'] = "<div class='badge badge-success'>Event successfully deleted</div><br/>";
                
                }
    
               $this->load_view($data); 
    
            }
        }

        public function show_modify($id) {

            if ($this->check_login()) {
    
                $data['view_name'] = 'form_modify_event';
                $data['event'] = $this->model_events->get($id);
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
    
            }
        }

        public function modify() {

            if ($this->check_login()) {
    
                $result = $this->model_events->modify();
    
                if ($result == 0) {
    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";
    
                }
                else {
    
                    $data['msg'] = "<div class='badge badge-success'>Event successfully modified</div><br/>";
    
                }
                
                $this->load_view($data); 
            }
        }
    }
?>
