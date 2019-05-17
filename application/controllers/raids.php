<?php

    include 'Security.php';

    class Raids extends Security
    {
        public function show_insert()
        {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_insert_raid';
                $this->load->view('template', $data);
            }
        }

        public function insert()
        {
            if ($this->check_permission(1)) {
                if ($this->form_validation->run('raids') == false) {
                    $data['view_name'] = 'form_insert_raid';
                    $data['msg'] = validation_errors();
                    $data['raid']['description'] = $this->input->post('description');
                    $this->load->view('template', $data);
                } else {
                    $description = quotes_to_entities($this->input->post('description'));
                    $date = $this->input->post('date');
                    $result_insert = $this->model_raids->insert($description, $date);
                    if ($result_insert == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Raid successfully created</div>");
                    }
                    $this->session->set_flashdata('table', 'raids');
                    redirect('admins');
                }
            }
        }

        public function delete($id)
        {
            if ($this->check_permission(1)) {
                $result = $this->model_raids->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Raid successfully deleted</div>");
                }
                $this->session->set_flashdata('table', 'raids');
                redirect('admins');
            }
        }

        public function show_modify($id)
        {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_modify_raid';
                $data['raid'] = $this->model_raids->get($id);
                $this->load->view('template', $data);
            }
        }

        public function modify()
        {
            if ($this->check_permission(1)) {
                if ($this->form_validation->run('raids') == false) {
                    $data['view_name'] = 'form_modify_raid';
                    $data['msg'] = validation_errors();
                    $data['raid']['id'] = $this->input->post('id');
                    $data['raid']['description'] = $this->input->post('description');
                    $data['raid']['date'] = $this->input->post('date');
                    $this->load->view('template', $data);
                } else {
                    $id = $this->input->post('id');
                    $description = quotes_to_entities($this->input->post('description'));
                    $date = $this->input->post('date');
                    $result = $this->model_raids->modify($id, $description, $date);
                    if ($result == 0) {
                        $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                    } else {
                        $this->session->set_flashdata('msg', "<div class='badge badge-success'>Raid successfully modified</div>");
                    }
                    $this->session->set_flashdata('table', 'raids');
                    redirect('admins');
                }
            }
        }
    }
