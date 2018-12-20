<?php

    include('Security.php');

    Class Officers extends Security {

        public function index($msg = null) {

            $data['view_name'] = 'officer_panel';
            $this->load->view('template', $data);

        }
        
    }
    
?>
