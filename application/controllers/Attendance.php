<?php

    include('Security.php');

    Class Attendance extends Security {
        
        public function show_insert() {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_insert_attendance_entry';
                $data['event_names'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $this->load->view('template', $data);    
            }

        }

        public function insert() {

            if ($this->check_login()) {    
                    $result_insert = $this->model_attendance->insert();    
                    if ($result_insert == 0) {    
                        $data['msg'] = "<div class='badge badge-danger'>Error on insertion</div><br/>";                    
                    }    
                    else {    
                        $data['msg'] = "<div class='badge badge-success'>Attendance Entry successfully inserted</div><br/>";    
                    }    
                $data["table_to_show"] = "attendance";
                $this->admin_panel($data);    
            }

        }

        public function delete($id) {

            if ($this->check_login()) {    
                $result = $this->model_attendance->delete($id);    
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on deletion</div><br/>";    
                }                
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Attendance Entry successfully deleted</div><br/>";                
                }
                $data["table_to_show"] = "attendance";
                $this->admin_panel($data);     
            }

        }

        public function show_modify($id) {

            if ($this->check_login()) {    
                $data['view_name'] = 'form_modify_attendance_entry';
                $data['event_names'] = $this->model_events->get_list();
                $data['character_names'] = $this->model_characters->get_list_names();
                $data['attendance_entry'] = $this->model_attendance->get($id);
                $this->load->view('template', $data);    
            }

        }

        public function modify() {

            if ($this->check_login()) {    
                $result = $this->model_attendance->modify();  
                if ($result == 0) {    
                    $data['msg'] = "<div class='badge badge-danger'>Error on modification</div><br/>";    
                }
                else {    
                    $data['msg'] = "<div class='badge badge-success'>Attendance Entry successfully modified</div><br/>";    
                }
                $data["table_to_show"] = "attendance";
                $this->admin_panel($data); 
            }

        }

    }
    
?>
