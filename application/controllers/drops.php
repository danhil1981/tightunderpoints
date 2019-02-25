<?php

    include("Security.php");

    Class Drops extends Security {

        public function show_insert() {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_insert_drop";
                $data["event_names"] = $this->model_events->get_list();
                $data["item_names"] = $this->model_items->get_list();
                $this->load->view("template", $data);
            }
        }

        public function insert() {
            if ($this->check_permission(1)) {
                $id_event = $this->input->post("id_event");
                $id_item = $this->input->post("id_item");
                $result_insert = $this->model_drops->insert($id_event, $id_item);
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "drops");
                redirect("admins");
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_drops->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "drops");
                redirect("admins");
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_modify_drop";
                $data["event_names"] = $this->model_events->get_list();
                $data["item_names"] = $this->model_items->get_list();
                $data["drop"] = $this->model_drops->get($id);
                $this->load->view("template", $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                $id = $this->input->post("id");
                $id_event = $this->input->post("id_event");
                $id_item = $this->input->post("id_item");
                $result = $this->model_drops->modify($id, $id_event, $id_item);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "drops");
                redirect("admins");
            }
        }

    }

?>
