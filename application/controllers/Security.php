<?php 

    Class Security extends CI_Controller {

        public function check_login() {
            $checked = false;
            if (!isset($this->session->logged_in)) {
                $data['msg'] = "<font color='red'>You need be logged in to do this!.</font><br/>";
                $this->load->view('form_login', $data);
            }
            else {
                $checked = true;
            }
            return $checked;
        }
    }
?>
