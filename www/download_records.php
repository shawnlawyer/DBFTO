<?php
include('bootstrap.php');
$file = DBF_To_Common::uploads().$_COOKIE['file'].'.records.json';
if(!file_exists($file)){exit;}
switch($site::$convert_to){
    case 'JSON':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"data.json");
        echo $controller::getJSONContents($file);
        exit;
    case 'XML':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"data.xml");
        echo DBF_To_Controller::convertToXML($controller::getJSON($file));
        exit;
    case 'CSV':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"data.csv");
        echo DBF_To_Controller::convertToCSV($controller::getJSON($file));
        exit;
    case 'XLSX':
        $exporter = new ExportDataExcel('browser', 'data.xlsx');
        $exporter->initialize();
        $data = $controller::getJSON($file);
        foreach($data as $row){
            $exporter->addRow($row);
        } 
        $exporter->finalize();
        exit();
    case 'HTML':
        header("Content-type: application/octet-stream");
		header("Content-Disposition: inline; filename=\"data.html");
        $table = new Table($controller::getJSON($file));
        $table->draw();
        exit();
}