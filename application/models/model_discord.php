<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_discord extends CI_Model {

        public function loot_update() {
            $last_loot = $this->get_last_loot();
            $name_character = $last_loot['name_character'];
            $id_item = $last_loot['id_item'];
            $name_item = html_entity_decode($last_loot['name_item'], ENT_QUOTES);
            if (in_array(substr($name_item,0,1), array('A','E','I','O','U'))) {
                $article = "an";
            }
            else {
                $article = "a";
            }
            $url = "https://discordapp.com/api/webhooks/547018898147377152/v4drrC20ptdDP_XiLBTZlT8ZabPtb3wJ7OOrV_rWrFUOjXtKjEx70mCRDRk73aK7LUyD";

            $hookObject = json_encode([
                "content" => ":gift: ".$name_character." has just won ".$article." ".$name_item.". Congratulations! :beers:",
                "username" => "Tight Underpoints",
                "tts" => true,
                "embeds" => [
                    [
                        "title" => $name_item,
                        "type" => "rich",
                        "url" => "http://allaclone.p2002.com/item.php?id=".$id_item,
                        "color" => "14177041",
                        "author" => [
                            "name" => $name_character,
                            "url" => "http://allaclone.p2002.com/magelo/?page=character&char=".$name_character
                        ]
                    ]
                ]
                
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

            $ch = curl_init();

            curl_setopt_array( $ch, [
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Length" => strlen( $hookObject ),
                    "Content-Type" => "application/json"
                ]
            ]);

            $response = curl_exec( $ch );
            curl_close( $ch );
        }

        public function get_last_loot() {
            $query = $this->db->query("SELECT 
                characters.name AS name_character,
                items.name AS name_item,
                items.id AS id_item
                FROM loot 
                INNER JOIN drops ON loot.id_drop = drops.id
                INNER JOIN events ON drops.id_event = events.id
                INNER JOIN characters ON loot.id_character = characters.id
                INNER JOIN items on drops.id_item = items.id
                ORDER BY drops.id DESC LIMIT 1
            ;");
            return $query->result_array()[0];
        }

    }

?>
