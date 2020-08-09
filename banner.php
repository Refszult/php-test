<?php

require 'VisitService.php';

$visitService = new VisitService($_SERVER);
$visitService->savingVisit();

$img = file_get_contents('https://i.picsum.photos/id/496/536/354.jpg?hmac=U8UJd7a1T_tp4baF1lfEma_vCZI9XA6ou60WNjRWC4s');
echo $img;

