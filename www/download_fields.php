<?php
include('bootstrap.php');
$file = DBF_To_Common::uploads().$_COOKIE['file'];
if($file == DBF_To_Common::uploads()){exit;}
header("Content-type: application/octet-stream");
switch($site::$convert_to){
    case 'JSON':
        echo json_encode(DBF_To_Controller::getFields($file));
        exit;
    case 'XML':
        echo DBF_To_Controller::convertToXML(DBF_To_Controller::getFields($file));
        exit;
    case 'CSV':
        echo DBF_To_Controller::convertToCSV(DBF_To_Controller::getFields($file));
        exit;
}