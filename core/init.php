<?php

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $home = 'https://';
} else {
  $home = 'http://';
}
$home   .= $_SERVER['HTTP_HOST'] . '/washinngarage';
$assets  = $home . '/assets';
$dbphp   = $_SERVER['DOCUMENT_ROOT'] . '/washinngarage/core/db.php';
$userphp =  $_SERVER['DOCUMENT_ROOT'] . '/washinngarage/core/user.php';

date_default_timezone_set("Asia/Bangkok");


session_start();
require_once "$dbphp";
require_once "$userphp";

?>

<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>