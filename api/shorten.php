<?php
// Parameters array to validate
$params = [
    "url"
];
// Verifies request method is POST, and that the URL is sent and is not empty
$post = $this->verifyPOSTData($params);
// Assign variable
$url = $post['url'];
// Verify the url is an actual URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    die("INVALID_URL");
}
// Valid characters array
$characters = str_split($this->valid_chars);
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
    if ($this->insertURL($short, $url)) {
        break;
    }
}
// Respond to frontend with complete URL
$shor10->response("SUCCESS", true);
