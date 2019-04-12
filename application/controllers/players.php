<?php

    include 'Security.php';

    class Players extends Security
    {
        public function show_insert($source = 'admins')
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_player';
                $data['source'] = $source;
                $this->load->view('template', $data);
            }
        }

        public function insert()
        {
            if ($this->check_permission(2)) {
                if ($this->form_validation->run('players') == false) {
                    $data['view_name'] = 'form_insert_player';
                    $data['msg'] = validation_errors();
                    $data['source'] = $this->input->post('source');
                    $data['player']['name'] = $this->input->post('name');
                    $this->load->view('template', $data);
                } else {
                    $source = $this->input->post('source');
                    $name = $this->input->post('name');
                    $result_insert = $this->model_players->insert($name);
                    if ($result_insert == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Player successfully created</div><br/>");
                    }
                    $this->session->set_flashdata('table', 'players');
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
                $result = $this->model_players->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Player successfully deleted</div><br/>");
                }
                $this->session->set_flashdata('table', 'players');
                if ($source == 'officers') {
                    redirect('officers');
                }
                redirect('admins');
            }
        }

        public function show_modify($id, $source = 'admins')
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_modify_player';
                $data['player'] = $this->model_players->get($id);
                $data['source'] = $source;
                $this->load->view('template', $data);
            }
        }

        public function modify()
        {
            if ($this->check_permission(2)) {
                if ($this->form_validation->run('players') == false) {
                    $data['view_name'] = 'form_modify_player';
                    $data['msg'] = validation_errors();
                    $data['source'] = $this->input->post('source');
                    $data['player']['id'] = $this->input->post('id');
                    $data['player']['name'] = $this->input->post('name');
                    $this->load->view('template', $data);
                } else {
                    $source = $this->input->post('source');
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $result = $this->model_players->modify($id, $name);
                    if ($result == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div><br/>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Player successfully modified</div><br/>");
                    }
                    $this->session->set_flashdata('table', 'players');
                    if ($source == 'officers') {
                        redirect('officers');
                    }
                    redirect('admins');
                }
            }
        }
    }
