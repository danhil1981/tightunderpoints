<?php

    include("Security.php");

    class Ajax extends Security
    {
        public function get_max()
        {
            if ($this->check_permission(3)) {
                $comparing = $this->input->post("comparing");
                print_r($this->model_characters->get_max($comparing));
                die;
            }
        }

        public function get_character_info()
        {
            if ($this->check_permission(3)) {
                $id_character= $this->input->post("id_character");
                print_r(json_encode($this->model_characters->get_character_info($id_character)));
                die;
            }
        }

        public function get_list_kills()
        {
            if ($this->check_permission(3)) {
                $id_boss = $this->input->post("id_boss");
                print_r(json_encode($this->model_bosses->get_list_kills($id_boss)));
                die;
            }
        }

        public function get_list_items()
        {
            if ($this->check_permission(3)) {
                $id_boss = $this->input->post("id_boss");
                print_r(json_encode($this->model_bosses->get_list_items($id_boss)));
                die;
            }
        }

        public function get_item_info()
        {
            if ($this->check_permission(3)) {
                $id_item = $this->input->post("id_item");
                print_r(json_encode($this->model_items->get_item_info($id_item)));
                die;
            }
        }

        public function get_events()
        {
            if ($this->check_permission(2)) {
                $id_raid = $this->input->post('id_raid');
                $events_in_raid = $this->model_events->get_events_in_raid($id_raid);
                print_r(json_encode($events_in_raid));
                die;
            }
        }

        public function get_drops()
        {
            if ($this->check_permission(2)) {
                $id_event = $this->input->post("id_event");
                $id_boss = $this->model_events->get_boss($id_event);
                $boss_items = $this->model_items->get_items($id_boss);
                print_r(json_encode($boss_items));
                die;
            }
        }

        public function get_boss()
        {
            if ($this->check_permission(2)) {
                $id_event = $this->input->post("id_event");
                print_r($this->model_events->get_boss($id_event));
                die;
            }
        }

        public function get_winner()
        {
            if ($this->check_permission(2)) {
                $comparing = $this->input->post("comparing");
                print_r($this->model_characters->get_winner($comparing));
                die;
            }
        }

        public function officer_insert_raid()
        {
            if ($this->check_permission(2)) {
                $description= quotes_to_entities($this->input->post("description"));
                $date = $this->input->post("date");
                print_r($this->model_raids->officer_insert($description, $date));
                die;
            }
        }

        public function officer_insert_item()
        {
            if ($this->check_permission(2)) {
                $id_item = $this->input->post("id_item");
                $name_item = quotes_to_entities($this->input->post("name_item"));
                $id_boss = $this->input->post("id_boss");
                $value_item = $this->input->post("value_item");
                print_r($this->model_items->officer_insert($id_item, $name_item, $id_boss, $value_item));
                die;
            }
        }

        public function officer_insert_event()
        {
            if ($this->check_permission(2)) {
                $time = $this->input->post("time");
                $date = $this->input->post("date");
                $timestamp = $date." ".$time;
                $id_boss = $this->input->post("id_boss");
                $id_raid = $this->input->post("id_raid");
                print_r(json_encode($this->model_events->officer_insert($timestamp, $id_boss, $id_raid)));
                die;
            }
        }
    }
