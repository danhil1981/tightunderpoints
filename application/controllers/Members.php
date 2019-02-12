<?php

    include('Security.php');

    Class Members extends Security {

        public function index() {
            if ($this->check_permission()) {
                $data['view_name'] = 'member_panel';
                $this->load->view('template', $data);
            }
        }
    }

?>
