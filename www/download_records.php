<?php
include('bootstrap.php');
$file = DBF_To_Common::uploads().$_COOKIE['file'];
if($file == DBF_To_Common::uploads()){exit;}
switch($site::$convert_to){
    case 'JSON':
        header("Content-type: application/octet-stream");
        echo json_encode(DBF_To_Controller::getRecords($file));
        exit;
    case 'XML':
        header("Content-type: application/octet-stream");
        echo DBF_To_Controller::convertToXML(DBF_To_Controller::getRecords($file));
        exit;
    case 'CSV':
        header("Content-type: application/octet-stream");
        echo DBF_To_Controller::convertToCSV(DBF_To_Controller::getRecords($file));
        exit;
    case 'XLSX':
        $exporter = new ExportDataExcel('browser', 'data.xlsx');
        $exporter->initialize();
        $data = DBF_To_Controller::getRecords($file);
        foreach($data as $row){
            $exporter->addRow($row);
        } 
        $exporter->finalize();
        exit();
    case 'HTML':
        header("Content-type: application/octet-stream");
        $table = new Table(DBF_To_Controller::getRecords($file));
        $table->draw();
        exit();
}