<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $radiologist =  $_POST['available-radiologist'];
    preg_match('#\((.*?)\)#', $radiologist, $match);
    $radiologist = $match[1];
    echo 'Radiologist: ' .  $radiologist;
}