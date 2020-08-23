<?php
require('simplehtmldom/simple_html_dom.php');

ini_set('max_execution_time', 0);
$strTrainName = file_get_contents('results.json');
$jsonTrainName = json_decode($strTrainName, true);
echo '<pre>' . print_r($jsonTrainName[], true) . '</pre>';
?>