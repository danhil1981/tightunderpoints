<?php

    include('Security.php');

    Class Loot extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_loot_entry';
                $data['drop_names'] = $this->model_drops->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $this->load->view('template', $data);    
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                    $result_insert = $this->model_loot->insert();    
                    if ($result_insert == 0) {    
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on insertion</div><br/>");                    
                    }    
                    else {    
                        $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully inserted</div><br/>");    
                    }    
                $data["table_to_show"] = "loot";
                $this->admin_panel($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_loot->delete($id);    
                if ($result == 0) {    
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on deletion</div><br/>");    
                }                
                else {    
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully deleted</div><br/>");                
                }
                $data["table_to_show"] = "loot";
                $this->admin_panel($data);     
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_loot_entry';
                $data['drop_names'] = $this->model_drops->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['loot_entry'] = $this->model_loot->get($id);
                $this->load->view('template', $data);    
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_loot->modify();  
                if ($result == 0) {    
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Error on modification</div><br/>");    
                }
                else {    
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully modified</div><br/>");    
                }
                $data["table_to_show"] = "loot";
                $this->admin_panel($data); 
            }

        }

    }
    
?>
