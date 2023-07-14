<?php

$name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name']:'';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password']:'';
$subject = (isset($_POST['subject']) && $_POST['subject'] != '') ? $_POST['subject']:'';
$content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content']:'';
$code = (isset($_POST['code']) && $_POST['code'] != '') ? $_POST['code']:'';

preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i",$content, $matches);

foreach($matches[1] AS $key =>$val){
    echo $val;
    echo"<br>";
    list($a, $b) = explode(';', $val);
    explode('/', $type);
    list(,$ext)=explode('/', $type);
    $ext = ($ext=='jpeg')?'jpg':$ext;
    echo $ext;
}