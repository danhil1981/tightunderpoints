<?php

    include('Security.php');

    Class Characters extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_character';
                $data['player_names'] = $this->model_players->get_list();
                $this->load->view('template', $data);    
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                $result_insert = $this->model_characters->insert();
                if ($result_insert == 0) {
                    $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                
                }
                else {
                    $data['msg'] = "<div class='badge badge-success'>Character successfully inserted</div><br/>";
                }    
                $data["table_to_show"] = "characters";
                $this->load_view($data);
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_characters->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Character successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "characters";
                $this->load_view($data);
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_character';
                $data['character'] = $this->model_characters->get($id);
                $data['player_names'] = $this->model_players->get_list();
                $this->load->view('template', $data);    
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_characters->modify();    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Character successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "characters";
                $this->load_view($data); 
            }

        }

    }
    
?>
