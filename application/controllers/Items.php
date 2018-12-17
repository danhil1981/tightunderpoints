<?php
    include('Security.php');

    Class Items extends Security {

        public function load_view($data = NULL) {
            $data['view_name'] = 'admin_panel';
            $data["table_to_show"] = "items";
            $this->load->view('template', $data);
        }

        
        public function show_insert() {

            if ($this->check_login()) {
    
                $data['view_name'] = 'form_insert_item';
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
    
            }
        }

        public function insert() {

            if ($this->check_login()) {
    
                    $result_insert = $this->model_items->insert();
    
                    if ($result_insert == 0) {
    
                        $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";
                    
                    }
    
                    else {
    
                        $data['msg'] = "<div class='badge badge-success'>Item successfully inserted</div><br/>";
    
                    }    
    
                $this->load_view($data);
    
            }
        }

        public function delete($id) {

            if ($this->check_login()) {
    
                $result = $this->model_items->delete($id);
    
                if ($result == 0) {
    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";
    
                }
                
                else {
    
                    $data['msg'] = "<div class='badge badge-success'>Item successfully deleted</div><br/>";
                
                }
    
               $this->load_view($data); 
    
            }
        }

        public function show_modify($id) {

            if ($this->check_login()) {
    
                $data['view_name'] = 'form_modify_item';
                $data['item'] = $this->model_items->get($id);
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
    
            }
        }

        public function modify() {

            if ($this->check_login()) {
    
                $result = $this->model_items->modify();
    
                if ($result == 0) {
    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";
    
                }
                else {
    
                    $data['msg'] = "<div class='badge badge-success'>Item successfully modified</div><br/>";
    
                }
                
                $this->load_view($data); 
            }
        }
    }
?>
