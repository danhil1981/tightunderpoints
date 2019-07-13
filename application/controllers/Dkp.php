<?php

    include 'Security.php';

    class Dkp extends Security
    {
        public function index()
        {
            $data['view_name'] = 'dkp';
            $this->load->view('template', $data);
        }
    }
