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
        'players' => [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[32]',
            ],
        ],
        'characters' => [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[32]',
            ],
        ],
        'bosses' => [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[64]',
            ],
        ],
        'items' => [
            [
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'required|integer|greater_than[0]|less_than[64001]',
            ],
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[64]',
            ],
        ],
        'items_modify' => [
            [
                'field' => 'id_new',
                'label' => 'ID',
                'rules' => 'required|integer|greater_than[0]|less_than[32769]',
            ],
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[64]',
            ],
        ],
        'raids' => [
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required|max_length[512]',
            ],
        ],
    ];

    $config['error_prefix'] = '<div class="badge badge-danger">';
    $config['error_suffix'] = '</div></br>';
