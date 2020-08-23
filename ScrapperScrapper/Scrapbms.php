<?php
require('simplehtmldom/simple_html_dom.php');
$context = stream_context_create(
    array(
        'http' => array(
            'follow_location' => false
        )
    )
);
ini_set('max_execution_time', 0);
 $url = "https://www.google.co.in";
$page=$htmlpage2 = file_get_html($url,FALSE,$context);

       echo $page;
       ?>