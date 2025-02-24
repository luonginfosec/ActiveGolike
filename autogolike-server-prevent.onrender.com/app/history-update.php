<?php 
$data = readfile("history-update.txt");
$json_string = json_encode($data, JSON_PRETTY_PRINT);
echo str_replace("432","","");