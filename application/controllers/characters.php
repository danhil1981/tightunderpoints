<?php

    include 'Security.php';

    class Characters extends Security
    {
        public function show_insert($source = 'admins')
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_character';
                $data['player_names'] = $this->model_players->get_list();
                $data['source'] = $source;
                $this->load->view('template', $data);
            }
        }

        public function insert()
        {
            if ($this->check_permission(2)) {
                if ($this->form_validation->run('characters') == false) {
                    $data['view_name'] = 'form_insert_character';
                    $data['msg'] = validation_errors();
                    $data['source'] = $this->input->post('source');
                    $data['player_names'] = $this->model_players->get_list();
                    $data['character']['name'] = $this->input->post('name');
                    $data['character']['level'] = $this->input->post('level');
                    $data['character']['class'] = $this->input->post('class');
                    $data['character']['type'] = $this->input->post('type');
                    $data['character']['id_player'] = $this->input->post('id_player');
                    $this->load->view('template', $data);
                } else {
                    $source = $this->input->post('source');
                    $name = $this->input->post('name');
                    $level = $this->input->post('level');
                    $class = $this->input->post('class');
                    $type = $this->input->post('type');
                    $id_player = $this->input->post('id_player');
                    $result_insert = $this->model_characters->insert($name, $level, $class, $type, $id_player);
                    if ($result_insert == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Character successfully created</div><br/>");
                    }
                    $this->session->set_flashdata('table', 'characters');
                    if ($source == 'officers') {
                        redirect('officers');
                    }
                    redirect('admins');
                }
            }
        }

        public function delete($id, $source = 'admins')
        {
            if ($this->check_permission(2)) {
                $result = $this->model_characters->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Character successfully deleted</div><br/>");
                }
                $this->session->set_flashdata('table', 'characters');
                if ($source == 'officers') {
                    redirect('officers');
                }
                redirect('admins');
            }
        }

        public function show_modify($id, $source = 'admins')
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_modify_character';
                $data['character'] = $this->model_characters->get($id);
                $data['player_names'] = $this->model_players->get_list();
                $data['source'] = $source;
                $this->load->view('template', $data);
            }
        }

        public function modify()
        {
            if ($this->check_permission(2)) {
                if ($this->form_validation->run('characters') == false) {
                    $data['view_name'] = 'form_modify_character';
                    $data['msg'] = validation_errors();
                    $data['source'] = $this->input->post('source');
                    $data['player_names'] = $this->model_players->get_list();
                    $data['character']['id'] = $this->input->post('id');
                    $data['character']['name'] = $this->input->post('name');
                    $data['character']['level'] = $this->input->post('level');
                    $data['character']['class'] = $this->input->post('class');
                    $data['character']['type'] = $this->input->post('type');
                    $data['character']['id_player'] = $this->input->post('id_player');
                    $this->load->view('template', $data);
                } else {
                    $source = $this->input->post('source');
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $level = $this->input->post('level');
                    $class = $this->input->post('class');
                    $type = $this->input->post('type');
                    $id_player = $this->input->post('id_player');
                    $result = $this->model_characters->modify($id, $name, $level, $class, $type, $id_player);
                    if ($result == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Character successfully modified</div><br/>");
                    }
                    $this->session->set_flashdata('table', 'characters');
                    if ($source == 'officers') {
                        redirect('officers');
                    }
                    redirect('admins');
                }
            }
        }
    }
