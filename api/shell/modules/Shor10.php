<?php

// Trait that handles HTTP2 pushing of certain assets
trait Shor10 {

    function setup() {
        // Create the URLs table if it doesn't exist
        $this->createURLTable();
    }

    function createURLTable() {
        $sql = "SELECT 1 FROM urls LIMIT 1;";
        $exists = $this->db->query($sql);
        // If the URLs table doesn't exist, create it
        if (!$exists) {
            $schema = $_SERVER['DOCUMENT_ROOT'] . "/schema.sql";
            // Get the schema file if it exists
            if (file_exists($schema)) {
                $sql = file_get_contents($schema);
                // Perform all the queries inside the schema
                $result = $this->db->multi_query($sql);
                if (!$result) {
                    // Couldn't create URLs table! Report error.
                    die("Error while creating URLs table.");
                }
            }
        }
    }

    function insertURL($short, $long) {
        // Escape the inserted long URL to combat mysql injections
        $long = $this->db->real_escape_string($long);
        // Format the domain string (e.g. https://www.example.com)
        $domain = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'];
        // Prepare the SQL query
        $sql = "SELECT short_url
                FROM urls
                WHERE long_url = '$long';
        ";
        $existing_short = $this->db->query($sql);
        // The URL has already been shortened! Return it.
        if ($existing_short) {
            $short = $existing_short;
        }
        else {
            // Long URL doesn't exist in database, let's insert it!
            $sql = "INSERT INTO urls (short_url, long_url)
                    VALUES
                    ('$short', '$long');
            ";
            $result = $this->db->query($sql);
            if (!$result) {
                // Couldn't insert the id! Report error.
                $this->response("SHORTEN_ERROR");
            }
        }
        // Format the domain string (e.g. https://www.example.com)
        $domain = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'];
        // Format the final redirection URL
        $short_link = "$domain/$short";
        // Return it to the frontend
        $this->response("SUCCESS", $short_link);
    }

    function prepareRedirect() {
        // Get the request URI
        $url = $_SERVER['REQUEST_URI'];
        // If it's length is 5 (slash inclusive, e.g. '/abcd')
        if (strlen($url) == 5) {
            // Get the last 4 chars
            $short = substr($url, -4);
            // Make sure the shortlink only contains our valid characters!
            if (preg_match("/^[0123456789ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]{4}$/", $short)) {
                $sql = "SELECT long_url
                        FROM urls
                        WHERE short_url = '$short';
                ";
                // Get the long URL of this shortlink
                //   If it is false, then the site will display
                //   a 404 error when rendering since the request URI doesn't
                //   belong to a valid page in the site
                $long = $this->db->query($sql);
                if ($long) {
                    // Redirect to the long URL
                    header("Location: " . $long);
                    die();
                }
            }
        }
    }

}
