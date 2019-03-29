<?php

    $config = array(
        'users' => array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[32]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[32]'
            )
        )
    );

    $config['error_prefix'] = '<div class="badge badge-danger">';
    $config['error_suffix'] = '</div></br>';
