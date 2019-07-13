<?php

    include 'Security.php';

    class Dkp extends Security
    {
        public function index()
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'dkp';
                $this->load->view('template', $data);
            }
        }
    }
