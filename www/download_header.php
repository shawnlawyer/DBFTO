<?php
include('bootstrap.php');
$file = DBF_To_Common::uploads().$_COOKIE['file'].'.head.json'
if(!file_exists($file)){exit;}
header("Content-type: application/octet-stream");
switch($site::$convert_to){
    case 'JSON':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"headers.json");
        echo DBF_To_Controller::getJSONContents($file);
        exit;
}