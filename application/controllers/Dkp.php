<?php

    include 'Security.php';

    class Dkp extends Security
    {
        public function index()
        {
            if ($this->check_permission(2)) {
                $this->load->view('dkp');
            }
        }
    }
