<?php

// Trait that handles HTTP2 pushing of certain assets
trait Shor10 {

    function setup() {
        $this->createURLTable();
    }

    function createURLTable() {
        $sql = "SELECT 1 FROM URLs LIMIT 1;";
        if (!($result = $this->db->query($sql))) {
            $schema = $_SERVER['DOCUMENT_ROOT'] . "/schema.sql";
            if (file_exists($schema)) {
                $sql = file_get_contents($schema);
                $result = $this->db->multi_query($sql);
                if (!$result) {
                    echo "Error while creating URLs table.";
                }
            }
        }
    }



    function insertURL($short, $long) {
        $long = $this->db->real_escape_string($long);

        $sql = "SELECT short_url
                FROM urls
                WHERE long_url = '$long';
        ";
        if (($result = $this->db->query($sql))) {

            if ($result) {
                $this->response("SUCCESS", $result);
            }

        }

        $sql = "INSERT INTO urls (short_url, long_url)
                VALUES
                ('$short', '$long');
        ";
        if (!($result = $this->db->query($sql))) {
            return false;
        }
    }

    function prepareRedirect() {
        $url = $_SERVER['REQUEST_URI'];


        if (strlen($url) == 5) {
            $short = substr($url, -4);
            if (preg_match("/^[0123456789ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]{4}$/", $short)) {
                $sql = "SELECT long_url
                        FROM urls
                        WHERE short_url = '$short';
                ";
                $long = $this->db->query($sql);
                if ($long) {
                    header("Location: " . $long);
                    die();

                }
            }
        }



    }

}
