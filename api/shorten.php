<?php
// Example response

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("POST_REQUIRED");
}

if ( !isset($_POST['long']) ) {
    die("LONG_URL_MISSING");
}

$long = $_POST['long'];

if (substr($long, 0, 7) !== "http://" and substr($long, 0, 8) !== "https://") {
    $long = "http://" . $long;
}

if (!filter_var($long, FILTER_VALIDATE_URL)) {
    die("INVALID_URL");
}

$characters = str_split("0123456789ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz");

$objects_count = count($characters);
$short_link_length = 4;
$combinations = pow($objects_count, $short_link_length);

for ($i=0; $i<$combinations; $i++) {
    $short = "";
    for ($i=0; $i<4; $i++) {
        $short.= $characters[rand()%$objects_count];
    }
    if ($this->insertURL($short, $long)) {
        break;
    }
}
















$shor10->response("SUCCESS", true);
