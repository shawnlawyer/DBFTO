<?php

class DBF_To_Controller {
    public static function convertToCSV($json){
        $json = json_decode($json);
        $csv = array();
        $modelList = 'modelList';
        $maxSubData = 0;
        foreach ($json as $id => $data){
            $maxSubData = max(array(count($data->modelList), $maxSubData ));
        }
        $headers = array();
        foreach ($json[0] as $key => $value){
            if($key == $modelList){
                for ($i = 1; $i <= $maxSubData; $i++){
                    $headers[] = $modelList . $i;
                }
            }else{
                $headers[] = $key;
            }
        }
        $csv[] = '"' . implode('","', $headers) . '"';
        foreach ($json as $data){
            $fieldValues = array();
            foreach ($data as $key => $value ){
                if ($key == $modelList){
                    $j = 0;
                    foreach ($value as $subValue){
                        $subData = array();
                        foreach ($subValue as $subCols){
                            $subData[] = $subCols;
                        }
                        $j++;
                        $fieldValues[] = htmlspecialchars(implode(':', $subData ));
                    }
                    for ($i = $j + 1; $i <= $maxSubData; $i++){
                        $fieldValues[] = '';
                    }
                }else{
                    $fieldValues[] = htmlspecialchars($value);
                }
            }

            $csv[] = '"' . implode('","', $fieldValues) . '"';
        }
        return implode("\n", $csv);
    }

    public static function convertToXML($array, $level=1) {
            $xml = '';
        foreach ($array as $key=>$value) {
            $key = strtolower($key);
            if (is_object($value)) {$value=get_object_vars($value);}
            
            if (is_array($value)) {
                $multi_tags = false;
                foreach($value as $key2=>$value2) {
                 if (is_object($value2)) {$value2=get_object_vars($value2);}
                    if (is_array($value2)) {
                        $xml .= str_repeat("\t",$level)."<$key>\n";
                        $xml .= array_to_xml($value2, $level+1);
                        $xml .= str_repeat("\t",$level)."</$key>\n";
                        $multi_tags = true;
                    } else {
                        if (trim($value2)!='') {
                            if (htmlspecialchars($value2)!=$value2) {
                                $xml .= str_repeat("\t",$level).
                                        "<$key2><![CDATA[$value2]]>".
                                        "</$key2>\n";
                            } else {
                                $xml .= str_repeat("\t",$level).
                                        "<$key2>$value2</$key2>\n";
                            }
                        }
                        $multi_tags = true;
                    }
                }
                if (!$multi_tags and count($value)>0) {
                    $xml .= str_repeat("\t",$level)."<$key>\n";
                    $xml .= array_to_xml($value, $level+1);
                    $xml .= str_repeat("\t",$level)."</$key>\n";
                }
          
             } else {
                if (trim($value)!='') {
                    if (htmlspecialchars($value)!=$value) {
                        $xml .= str_repeat("\t",$level)."<$key>".
                                "<![CDATA[$value]]></$key>\n";
                    } else {
                        $xml .= str_repeat("\t",$level).
                                "<$key>$value</$key>\n";
                    }
                }
            }
        }
        return $xml;
    }

    public static function getRecords($dbfname) { 
        $seperator = '';
        $fdbf = fopen($dbfname,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8)); 
        $goon = true; 
        $unpackString=''; 
        while ($goon && !feof($fdbf)) { // read fields: 
            $buf = fread($fdbf,32); 
            if (substr($buf,0,1)==chr(13)) {
                $goon=false; // end of field list 
            } else { 
                $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18)); 
                $unpackString.="A$field[fieldlen]$field[fieldname]/"; 
                array_push($fields, $field);
            }
        } 
        fseek($fdbf, $header['FirstRecord']+1); // move back to the start of the first record (after the field definitions)
        $print_records = array();
        for ($i=1; $i<=$header['RecordCount']; $i++) {
            
            $buf = fread($fdbf,$header['RecordLength']); 
            $record=unpack($unpackString,$buf);
            $print_record = array();
            foreach($record as $key => $value){
                $print_record[$key] = trim($value);
            }
            $print_records[] = json_decode(str_replace('\\u0000', "", json_encode($print_record)));
            $seperator = ",\n";
        }
        fclose($fdbf);
        return $print_records;
    }

    public static function getFields($dbfname) { 
        $fdbf = fopen($dbfname,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8)); 
        $goon = true; 
        $seperator = '';
        $unpackString=''; 
        $print_fields = array();
        while ($goon && !feof($fdbf)) { // read fields: 
            $buf = fread($fdbf,32); 
            if (substr($buf,0,1)==chr(13)) {
                $goon=false; // end of field list 
            } else { 
                $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18)); 
                $print_field = array();
                foreach($field as $key => $value){
                    $print_field[$key] = trim($value);
                }
                $print_fields[] = json_decode(str_replace('\\u0000', "", json_encode($print_field)));
                $unpackString.="A$field[fieldlen]$field[fieldname]/"; 
                array_push($fields, $field);
            }
        }
        fclose($fdbf); 
        return $print_fields;
    }

    public static function getHeader($dbfname) { 
        $fdbf = fopen($dbfname,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8)); 
        $print_header = array();
        foreach($header as $key => $value){
            $print_header[$key] = trim($value);
        }
        fclose($fdbf); 
        return json_decode(str_replace('\\u0000', "", json_encode($print_header)));
    }
    
    public static function getJSONContents($file) { 
        return self::getFileContents($file);
    }
    public static function getJSON($file) { 
        return json_decode(self::getJSONContents($file));
    }
    public static function getUploadedFileContents($file) { 
        return utf8_encode(self::getFileContents($file));
    }
    public static function getFileContents($file) { 
        return file_get_contents($file);
    }
    public static function deleteUploadedFile($file) { 
        return unlink($file);
    }
    public static function saveFile($file,$contents) { 
        $r = fopen($file, 'w');
        if(fwrite($r, $contents)){
            fclose($r);
            return true;
        }
        return false;
    }
}

abstract class ExportData {
	protected $exportTo;
	protected $stringData;
	protected $tempFile;
	protected $tempFilename;

	public $filename;

	public function __construct($exportTo = "browser", $filename = "exportdata") {
		if(!in_array($exportTo, array('browser','file','string') )) {
			throw new Exception("$exportTo is not a valid ExportData export type");
		}
		$this->exportTo = $exportTo;
		$this->filename = $filename;
	}
	
	public function initialize() {
		
		switch($this->exportTo) {
			case 'browser':
				$this->sendHttpHeaders();
				break;
			case 'string':
				$this->stringData = '';
				break;
			case 'file':
				$this->tempFilename = tempnam(sys_get_temp_dir(), 'exportdata');
				$this->tempFile = fopen($this->tempFilename, "w");
				break;
		}
		
		$this->write($this->generateHeader());
	}
	
	public function addRow($row) {
		$this->write($this->generateRow($row));
	}
	
	public function finalize() {
		
		$this->write($this->generateFooter());
		
		switch($this->exportTo) {
			case 'browser':
				flush();
				break;
			case 'string':
				break;
			case 'file':
				fclose($this->tempFile);
				rename($this->tempFilename, $this->filename);
				break;
		}
	}
	
	public function getString() {
		return $this->stringData;
	}
	
	abstract public function sendHttpHeaders();
	
	protected function write($data) {
		switch($this->exportTo) {
			case 'browser':
				echo $data;
				break;
			case 'string':
				$this->stringData .= $data;
				break;
			case 'file':
				fwrite($this->tempFile, $data);
				break;
		}
	}
	
	protected function generateHeader() {
		// can be overridden by subclass to return any data that goes at the top of the exported file
	}
	
	protected function generateFooter() {
		// can be overridden by subclass to return any data that goes at the bottom of the exported file		
	}
	abstract protected function generateRow($row);
	
}

class ExportDataTSV extends ExportData {
	
	function generateRow($row) {
		foreach ($row as $key => $value) {
			$row[$key] = '"'. str_replace('"', '\"', $value) .'"';
		}
		return implode("\t", $row) . "\n";
	}
	
	function sendHttpHeaders() {
		header("Content-type: text/tab-separated-values");
    header("Content-Disposition: attachment; filename=".basename($this->filename));
	}
}

class ExportDataCSV extends ExportData {
	
	function generateRow($row) {
		foreach ($row as $key => $value) {
			$row[$key] = '"'. str_replace('"', '\"', $value) .'"';
		}
		return implode(",", $row) . "\n";
	}
	
	function sendHttpHeaders() {
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=".basename($this->filename));
	}
}


class ExportDataExcel extends ExportData {
	
	const XmlHeader = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
	const XmlFooter = "</Workbook>";
	
	public $encoding = 'UTF-8';
	public $title = 'Sheet1';
	
	function generateHeader() {
		$output = stripslashes(sprintf(self::XmlHeader, $this->encoding)) . "\n";
		$output .= "<Styles>\n";
		$output .= "<Style ss:ID=\"sDT\"><NumberFormat ss:Format=\"Short Date\"/></Style>\n";
		$output .= "</Styles>\n";
        
		$output .= sprintf("<Worksheet ss:Name=\"%s\">\n    <Table>\n", htmlentities($this->title));
		
		return $output;
	}
	
	function generateFooter() {
		$output = '';
        
		$output .= "    </Table>\n</Worksheet>\n";
		$output .= self::XmlFooter;
		
		return $output;
	}
	
	function generateRow($row) {
		$output = '';
		$output .= "        <Row>\n";
		foreach ($row as $k => $v) {
			$output .= $this->generateCell($v);
		}
		$output .= "        </Row>\n";
		return $output;
	}
	
	private function generateCell($item) {
		$output = '';
		$style = '';
		if(preg_match("/^-?\d+(?:[.,]\d+)?$/",$item) && (strlen($item) < 15)) {
			$type = 'Number';
		}
		elseif(preg_match("/^(\d{1,2}|\d{4})[\/\-]\d{1,2}[\/\-](\d{1,2}|\d{4})([^\d].+)?$/",$item) &&
					($timestamp = strtotime($item)) &&
					($timestamp > 0) &&
					($timestamp < strtotime('+500 years'))) {
			$type = 'DateTime';
			$item = strftime("%Y-%m-%dT%H:%M:%S",$timestamp);
			$style = 'sDT';
		}
		else {
			$type = 'String';
		}
				
		$item = str_replace('&#039;', '&apos;', htmlspecialchars($item, ENT_QUOTES));
		$output .= "            ";
		$output .= $style ? "<Cell ss:StyleID=\"$style\">" : "<Cell>";
		$output .= sprintf("<Data ss:Type=\"%s\">%s</Data>", $type, $item);
		$output .= "</Cell>\n";
		
		return $output;
	}
	
	function sendHttpHeaders() {
		header("Content-Type: application/vnd.ms-excel; charset=" . $this->encoding);
		header("Content-Disposition: inline; filename=\"" . basename($this->filename) . "\"");
	}
	
}
class Table {
    protected $opentable = "<table cellspacing=\"0\" cellpadding=\"0\">\n";
    protected $closetable = "</table>\n";
    protected $openrow = "\t<tr>\n";
    protected $closerow = "\t</tr>\n";

    function __construct($data) {
        $this->string = $this->opentable;
        foreach ($data as $row) {
            $this->string .= $this->buildrow($row);
        }
        $this->string .= $this->closetable;
    }

    function addfield($field, $style = "null") {
        if ($style == "null") {
            $html =  "\t\t<td>" . $field . "</td>\n";
        } else {
            $html = "\t\t<td class=\"" . $style . "\">"  . $field . "</td>\n";
        }
        return $html;
    }

    function buildrow($row) {
        $html .= $this->openrow;
        foreach ($row as $field) {
            $html .= $this->addfield($field);
        }
        $html .= $this->closerow;
        return $html;
    }

    function draw() {
        echo $this->string;
    }
}