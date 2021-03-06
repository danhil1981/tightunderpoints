<?php

    include 'Security.php';

    class Events extends Security
    {
        public function show_insert($source = 'admins', $id_boss = null)
        {
            if ($this->check_permission(2)) {
                $data['view_name'] = 'form_insert_event';
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $data['source'] = $source;
                if (isset($id_boss)) {
                    $data['id_boss'] = $id_boss;
                }
                $this->load->view('template', $data);
            }
        }

        public function insert()
        {
            if ($this->check_permission(2)) {
                $source = $this->input->post('source');
                $time = $this->input->post('time');
                $date = $this->input->post('date');
                $url_parse = $this->input->post('url_parse');
                $timestamp = $date . ' ' . $time;
                $id_boss = $this->input->post('id_boss');
                $id_raid = $this->input->post('id_raid');
                $result_insert = $this->model_events->insert($timestamp, $id_boss, $id_raid, $url_parse);
                if ($result_insert == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Event successfully created</div>");
                }

                if ($source == 'officers') {
                    $this->session->set_flashdata('table', 'timers');
                    redirect('officers');
                }
                $this->session->set_flashdata('table', 'events');
                redirect('admins');
            }
        }

        public function delete($id)
        {
            if ($this->check_permission(1)) {
                $result = $this->model_events->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Event successfully deleted</div>");
                }
                $this->session->set_flashdata('table', 'events');
                redirect('admins');
            }
        }

        public function show_modify($id)
        {
            if ($this->check_permission(1)) {
                $data['view_name'] = 'form_modify_event';
                $data['event'] = $this->model_events->get($id);
                $data['raid_descriptions'] = $this->model_raids->get_list();
                $data['boss_names'] = $this->model_bosses->get_list();
                $this->load->view('template', $data);
            }
        }

        public function modify()
        {
            if ($this->check_permission(1)) {
                $id = $this->input->post('id');
                $time = $this->input->post('time');
                $date = $this->input->post('date');
                $url_parse = $this->input->post('url_parse');
                $timestamp = $date . ' ' . $time;
                $id_boss = $this->input->post('id_boss');
                $id_raid = $this->input->post('id_raid');
                $result = $this->model_events->modify($id, $timestamp, $id_boss, $id_raid, $url_parse);
                if ($result == 0) {
                    $this->session->set_flashdata('msg', "<div class='badge badge-danger'>Database Error</div>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='badge badge-success'>Event successfully modified</div>");
                }
                $this->session->set_flashdata('table', 'events');
                redirect('admins');
            }
        }
    }
