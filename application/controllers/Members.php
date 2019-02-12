<?php

    include('Security.php');

    Class Members extends Security {

        public function index() {
            $data['view_name'] = 'member_panel';
            $this->load->view('template', $data);
        }
    }

?>
