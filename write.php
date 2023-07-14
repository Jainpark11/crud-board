<?php
include 'dbconfig.php';

$name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
$subject = (isset($_POST['subject']) && $_POST['subject'] != '') ? $_POST['subject'] : '';
$content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';
$code = (isset($_POST['code']) && $_POST['code'] != '') ? $_POST['code'] : '';

if ($code == 'undefined') {
    $code = 'freeboard';
}

$pwd_hash = password_hash($password, PASSWORD_BCRYPT);

preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $matches);

foreach ($matches[1] as $key => $val) {

    list($type, $data) = explode(';', $val);
    list(, $ext) = explode('/', $type);
    $ext = ($ext == 'jpeg') ? 'jpg' : $ext;
    $filename = date('YmdHis') . '_' . $key . '.' . $ext;
    list(, $base64_decode_data) = explode(',', $data);
    echo $base64_decode_data;

    $rs_code = base64_decode($base64_decode_data);
    file_put_contents("./upload/" . $filename, $rs_code);
    $img_array[] = "upload/" . $filename;

    $content = str_replace($val, "./upload/" . $filename, $content);
}

$imglist = implode('|', (array)$img_array);

$sql = "INSERT INTO mboard (code, name, subject, password, content, imglist, ip, rdate) VALUES(:code, :name, :subject, :password, :content, :imglist, :ip, NOW())";

$ip = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare($sql);
$stmt->bindParam(':code', $code);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':imglist', $imglist);
$stmt->bindParam(':ip', $ip);
$stmt->execute();
$arr = ['result' => 'success'];
$j = json_encode($arr);
die($j);



