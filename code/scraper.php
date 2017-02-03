<?php
require_once('simple_html_dom.php');
$url  = 'nwt_E/OEBPS/1001061124.xhtml';
$html = file_get_html($url);

$verse = $html->find('#chapter1_verse1');

foreach($verse as $text){
    print_r($text->plaintext);
}

?>