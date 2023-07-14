<?php

$code = (isset($_GET['code']) && $_GET['code'] != '') ? $_GET['code'] : '';

switch($_GET['code']){
    case 'freeboard' : $board_title = '게시판'; 
    break;
    case 'notice': $board_title = '공지사항';
    break;
    default : $code = 'code'; $board_title = '자유게시판';
}