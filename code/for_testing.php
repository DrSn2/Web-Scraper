<?php
    require_once('simple_html_dom.php');
    require_once('randomua.php');

    $keywords = array("sewing","sewing%20machines");
    $start = 0;
    foreach($keywords as $keyword){
        $pages_to_check = array('0','10','20','30','40','50');

        foreach($pages_to_check as $page){
            sleep ( rand ( 1, 5));
            $url = 'https://www.google.com/search?q='.$keyword.'&start='.$page;
            $opts = array('http'=>array('header'=>random_uagent()));
 
            $context = stream_context_create($opts);
            $html = file_get_html($url,false,$context);
            $i = 1;
            $linkObjs = $html->find('h3.r a');
            echo 'Page:'.$page.'<br><br>';

                foreach($linkObjs as $linkObj){

                    if(preg_match('/sewing/', $linkObj)){
                    echo $keyword.': '.$linkObj." Page Rank: ".$i.'<br><br>';
                    }
        
                    $i++;
        
                }
         }
        
    }
?>