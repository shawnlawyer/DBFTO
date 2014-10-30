<?php
require_once('bootstrap.php');

ini_set('max_input_time', '2592000');
ini_set('memory_limit', '400M');
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');
ini_set('memory_limit', '400M');
ini_set('max_execution_time', '2592000');
ini_set('max_file_uploads', '1');

if (isset($_FILES["file"])) {
    //check file type and size here
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {
        $filename = sha1(time().$_FILES["file"]["tmp_name"]);
        setcookie ("file", $filename, time() + 3600, "/", $site::$domain);
        move_uploaded_file($_FILES["file"]["tmp_name"], DBF_To_Common::uploads() . $filename);
        ?>
        <div class="subline">Download the dbase DBF data converted to <?=$site::$convert_to?></div>
        <?php
        switch($site::$convert_to){
            case 'JSON':
                <a class="btn" target="_blank"href="download_header.php">Header</a> &nbsp; 
                <a class="btn" target="_blank"href="download_fields.php">Fields</a> &nbsp;
                <?
                break;
            case 'XML':
            case 'CSV':
            case 'XLSX':
            case 'HTML':
                break;
        }
        ?>
        <a class="btn"  target="_blank"href="download_records.php">Records</a>
        <br>
        <br>
        <?php        
    }
}