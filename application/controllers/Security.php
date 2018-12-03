<?php 

    Class Security extends CI_Controller {

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
