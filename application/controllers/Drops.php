<?php

    include('Security.php');

    Class Drops extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_drop';
                $data['event_names'] = $this->model_events->get_list();
                $data['item_names'] = $this->model_items->get_list();
                $this->load->view('template', $data);    
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                    $result_insert = $this->model_drops->insert();    
                    if ($result_insert == 0) {    
                        $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                    
                    }    
                    else {    
                        $data['msg'] = "<div class='badge badge-success'>Drop successfully inserted</div><br/>";    
                    }    
                $data["table_to_show"] = "drops";
                $this->load_view($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_drops->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Drop successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "drops";
                $this->load_view($data);     
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_drop';
                $data['event_names'] = $this->model_events->get_list();
                $data['item_names'] = $this->model_items->get_list();
                $data['drop'] = $this->model_drops->get($id);
                $this->load->view('template', $data);    
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_drops->modify();  
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Drop successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "drops";
                $this->load_view($data); 
            }

        }

    }
    
?>
