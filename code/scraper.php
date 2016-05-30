<?php
require_once('simple_html_dom.php');
$url  = 'https://www.google.com/search?q=sewing+classes+santa+rosa+ca&oq=sewing+machines';
$html = file_get_html($url);

$linkObjs = $html->find('h3.r a');
foreach ($linkObjs as $linkObj) {
    $title = trim($linkObj->plaintext);
    $link  = trim($linkObj->href);
    
    // if it is not a direct link but url reference found inside it, then extract
    if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
        $link = $matches[1];
    } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
        continue;    
    }
    
    echo '<p>Title: ' . $title . '<br />';
    echo 'Link: ' . $link . '</p>';    
}
?>