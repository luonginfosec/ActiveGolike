<?php 
function json($status,$msg)
{
    $data['data'] = [
        "success" => $status,
        "message" => $msg,
    ];
    die(json_encode($data,JSON_PRETTY_PRINT));
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_TRANSFERTEXT,true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
if(isset($_GET['key']))
{   
    $data = readfile("login.txt");
    $json_string = json_encode($data, JSON_PRETTY_PRINT);
    echo str_replace("432","","");
}

















