<?php

    include("Security.php");

    class Bosses extends Security
    {
        public function show_insert()
        {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_insert_boss";
                $this->load->view("template", $data);
            }
        }

        public function insert()
        {
            if ($this->check_permission(1)) {
                $name = quotes_to_entities($this->input->post("name"));
                $respawn = $this->input->post("respawn");
                $variance = $this->input->post("variance");
                $value = $this->input->post("value");
                $result_insert = $this->model_bosses->insert($name, $respawn, $variance, $value);
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg", "<div class='badge badge-danger'>Database Error</div><br/>");
                } else {
                    $this->session->set_flashdata("msg", "<div class='badge badge-success'>Boss successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "bosses");
                redirect("admins");
            }
        }

        public function delete($id)
        {
            if ($this->check_permission(1)) {
                $result = $this->model_bosses->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg", "<div class='badge badge-danger'>Database Error</div><br/>");
                } else {
                    $this->session->set_flashdata("msg", "<div class='badge badge-success'>Boss successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "bosses");
                redirect("admins");
            }
        }

        public function show_modify($id)
        {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_modify_boss";
                $data["boss"] = $this->model_bosses->get($id);
                $this->load->view("template", $data);
            }
        }

        public function modify()
        {
            if ($this->check_permission(1)) {
                $id = $this->input->post("id");
                $name = quotes_to_entities($this->input->post("name"));
                $respawn = $this->input->post("respawn");
                $variance = $this->input->post("variance");
                $value = $this->input->post("value");
                $result = $this->model_bosses->modify($id, $name, $respawn, $variance, $value);
                if ($result == 0) {
                    $this->session->set_flashdata("msg", "<div class='badge badge-danger'>Database Error</div><br/>");
                } else {
                    $this->session->set_flashdata("msg", "<div class='badge badge-success'>Boss successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "bosses");
                redirect("admins");
            }
        }
    }
