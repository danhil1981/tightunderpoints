<?php

    include("Security.php");

    Class Users extends Security {

        public function index($msg = null) {
            $data["view_name"] = "form_login";
            if ($msg != null) $data["msg"] = $msg;
            $this->load->view("template", $data);
        }

        public function show_insert() {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_insert_user";
                $this->load->view("template", $data);
            }
        }

        public function insert() {
            if ($this->check_permission(1)) {
                if ($this->form_validation->run('users') == FALSE) {
                    $data["view_name"] = "form_insert_user";
                    $this->load->view("template", $data);
                }
                else {
                    $name = $this->input->post("name");
                    $password = $this->input->post("password");
                    $type = $this->input->post("type");
                    $result_insert = $this->model_users->insert($name, $password, $type);
                    if ($result_insert == 0) {
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                    }
                    else {
                        $this->session->set_flashdata("msg","<div class='badge badge-success'>User successfully created</div><br/>");
                    }
                    $this->session->set_flashdata("table", "users");
                    redirect("admins");
                }
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_users->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>User successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "users");
                redirect("admins");
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_modify_user";
                $data["user"] = $this->model_users->get($id);
                $this->load->view("template", $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                if ($this->form_validation->run('users') == FALSE) {
                    $data["view_name"] = "form_modify_user";
                    $this->load->view("template", $data);
                }
                else {
                    $id = $this->input->post("id");
                    $name = $this->input->post("name");
                    $password = $this->input->post("password");
                    $type = $this->input->post("type");
                    $result = $this->model_users->modify($id, $name, $password, $type);
                    if ($result == 0) {
                        $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                    }
                    else {
                        $this->session->set_flashdata("msg","<div class='badge badge-success'>User successfully modified</div><br/>");
                    }
                    $this->session->set_flashdata("table", "users");
                    redirect("admins");
                }
            }
        }

    }

?>
