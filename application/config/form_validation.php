<?php

    $config = [
        'users' => [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[32]',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[32]',
            ],
        ],
    ];

    $config['error_prefix'] = '<div class="badge badge-danger">';
    $config['error_suffix'] = '</div></br>';
