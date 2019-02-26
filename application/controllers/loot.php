<?php

    include("Security.php");

    Class Loot extends Security {

        public function show_insert() {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_insert_loot_entry";
                $data["drop_names"] = $this->model_drops->get_list();
                $data["character_names"] = $this->model_characters->get_list_names();
                $this->load->view("template", $data);
            }
        }

        public function insert() {
            if ($this->check_permission(1)) {
                $id_drop = $this->input->post("id_drop");
                $id_character = $this->input->post("id_character");
                $result_insert = $this->model_loot->insert($id_drop, $id_character);
                if ($result_insert == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully created</div><br/>");
                }
                $this->session->set_flashdata("table", "loot");
                redirect("admins");
            }
        }

        public function delete($id) {
            if ($this->check_permission(1)) {
                $result = $this->model_loot->delete($id);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully deleted</div><br/>");
                }
                $this->session->set_flashdata("table", "loot");
                redirect("admins");
            }
        }

        public function show_modify($id) {
            if ($this->check_permission(1)) {
                $data["view_name"] = "form_modify_loot_entry";
                $data["drop_names"] = $this->model_drops->get_list();
                $data["character_names"] = $this->model_characters->get_list_names();
                $data["loot_entry"] = $this->model_loot->get($id);
                $this->load->view("template", $data);
            }
        }

        public function modify() {
            if ($this->check_permission(1)) {
                $id = $this->input->post("id");
                $id_drop = $this->input->post("id_drop");
                $id_character = $this->input->post("id_character");
                $result = $this->model_loot->modify($id, $id_drop, $id_character);
                if ($result == 0) {
                    $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error</div><br/>");
                }
                else {
                    $this->session->set_flashdata("msg","<div class='badge badge-success'>Loot Entry successfully modified</div><br/>");
                }
                $this->session->set_flashdata("table", "loot");
                redirect("admins");
            }
        }

        public function show_officer_insert($id) {
            if ($this->check_permission(2)) {
                $data["view_name"] = "form_insert_loot";
                $data["id_character"] = $id;
                $data["character_names"] = $this->model_characters->get_list_names();
                $data["raid_descriptions"] = $this->model_raids->get_list();
                $data["boss_names"] = $this->model_bosses->get_list();
                $data["events_not_in_raid"] = $this->model_events->get_events_not_in_raid();
                $this->load->view("template", $data);
            }
        }

        public function officer_insert() {
            if ($this->check_permission(2)) {
                $id_item = $this->input->post("id_item");
                $id_event = $this->input->post("id_event");
                $id_character = $this->input->post("id_character");
                $result_insert = $this->model_loot->officer_insert($id_item, $id_event, $id_character);
                switch ($result_insert) {
                    case "0": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error (drop)</div><br/>");
                    break;
                    case "1": $this->session->set_flashdata("msg","<div class='badge badge-danger'>Database Error (loot)</div><br/>");
                    break;
                    default: $this->session->set_flashdata("msg","<div class='badge badge-success'>Drop and Loot Entries successfully created</div><br/>");
                    //$this->model_discord->loot_update();
                }
                $this->session->set_flashdata("table", "points");
                redirect("officers");
            }
        }

    }

?>
