<?php

require('simplehtmldom/simple_html_dom.php');

ini_set('max_execution_time', 0);


$j = 0;
$alph = 'abcdefghijklmnopqrstuvwxyz';
for ($j = 0; $j < 27;) {
    $flag = TRUE;
    $i = 0;
    while ($flag == TRUE) {

        $url = "https://www.makemytrip.com/railways/list-of-indian-railway-trains-by-" . $alph[$j] . ".html?page=" . $i;
        echo $url;
        $html = file_get_html($url);
        if ($html->find('span[class=field-content] a')) {


            foreach ($html->find('span[class=field-content] a') as $ul) {

                $TrainNamearr[] = $ul->plaintext;
                print_r($TrainNamearr);
            }

            $i++;
        } else {
            $flag = FALSE;
        }
    }
    $TrainNameJson = json_encode($TrainNamearr);
    $fp = fopen('results.json', 'w');
    fwrite($fp, $TrainNameJson);
    fclose($fp);
    echo sizeof($TrainNamearr);
      $j++;
}
?>