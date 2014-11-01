<?php
include('bootstrap.php');
$file = DBF_To_Common::uploads().$_COOKIE['file'].'.fields.json';
if(!file_exists($file)){exit;}
header("Content-type: application/octet-stream");
switch($site::$convert_to){
    case 'JSON':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"fields.json");
        echo DBF_To_Controller::getJSONContents($file);
        exit;
    case 'XML':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"schema.xml");
        echo DBF_To_Controller::convertToXML(DBF_To_Controller::getJSON($file));
        exit;
}