<?php

require 'VisitService.php';
require 'Repository.php';

$visitService = new VisitService(new Repository(parse_ini_file('.env', false, INI_SCANNER_RAW)));
$visitService->savingVisit([
    'ip' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'view_date' => date("y.m.d"),
    'page_url' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
]);

$img = file_get_contents('https://i.picsum.photos/id/496/536/354.jpg?hmac=U8UJd7a1T_tp4baF1lfEma_vCZI9XA6ou60WNjRWC4s');
echo $img;

