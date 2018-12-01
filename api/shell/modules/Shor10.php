<?php

// Trait that handles HTTP2 pushing of certain assets
trait Shor10 {

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

    function setup() {
        $this->createURLTable();
    }

}
