<?php 
$data = readfile("about.txt");
$json_string = json_encode($data, JSON_PRETTY_PRINT);
echo str_replace("432","","");