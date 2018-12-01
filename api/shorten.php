<?php
// POST method required
$shor10->checkPOST();
// Verify URL is sent
if (!isset($_POST['url'])) {
    $shor10->response("FORM_DATA_MISSING");
}
if (empty($_POST['url'])) {
    $shor10->response("EMPTY_URL");
}
// Assign variable
$url = $_POST['url'];
// Verify the url is an actual URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    $shor10->response("INVALID_URL");
}
// Valid characters array
$characters = str_split($shor10->valid_chars);
// Count how many combinations we can make with the characters and
// short URLs with length = 4
//   Read: Combinatorics: Permutation with Repetitions
$objects_count = count($characters);
$short_link_length = 4;
$combinations = pow($objects_count, $short_link_length);
// Create short URLs and find the first not to be already taken
//   We use a for loop instead of while(true) so as to avoid an infinite loop
for ($i=0; $i<$combinations; $i++) {
    $short = "";
    for ($i=0; $i<4; $i++) {
        // Get each character of the short URL randomly
        $short.= $characters[rand() % $objects_count];
    }
    // If the insert was successful, break
    if ($shor10->insertURL($short, $url)) {
        break;
    }
}
// Respond to frontend with complete URL
$shor10->response("SUCCESS", true);
