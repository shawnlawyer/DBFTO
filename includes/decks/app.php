<?php
require_once('bootstrap.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php include('html/head-tags.php');?>
</head>
    <body class="alignCenter">
        <div id="headContainer" class="fitBlock">
            <div class="site-header">DBF to <?=$site::$convert_to?></div>
        </div>  
        <br>
        <br>  
        <br>
        <br>  
        <br>
        <br>
        <br>
        <br> 
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <?=$site::$google_ad_block_1?>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/follow-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <div class="headline">3 Easy Steps</div>
        <br>
        <div class="card alignLeft">
            <div class="subline">With DBFto online tools, you can convert any DBF to  <?=$site::$convert_to?> free in 3 easy steps. </div>
            <div style="height:2px;"></div>
            <div class="subline">Step 1.</div>
            <div class="content">&nbsp;Choose a dBase DBF to convert. Up to 200mb for free.</div>
            <div class="subline">Step 2.</div>
            <div class="content">&nbsp;Upload your dBase DBF file! We open dbf files and convert the data.</div>
            <div class="subline">Step 3.</div>
            <div class="content">&nbsp;Then you have 5 minute to download your transformed dbf data as <?=$site::$convert_to?>.</div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="headline">Step 1</div>
        <br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="subline">Choose a dbase DBF file to convert to <?=$site::$convert_to?></div>
                    <input class="btn" type="file" name="file">
                <br>
                <br>
            </div>
            <br> 
            <br> 
            <br>
            <div class="headline">Step 2</div>
            <br>
            <div class="card">
                <div class="subline">Upload DBF file</div>
                    <input class="btn" type="submit" value="Upload">
                <br>
                <br>
                <div id="progressbar" class="card progress">
                    <div class="bar"></div>
                </div>
            </div>
        </form>
        <br>
        <br> 
        <div class="headline">Step 3</div>
        <br>
        <div class="card" id="status">
            <div class="subline">Your downloads will appear here!</div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/related-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <?=$site::$google_ad_block_2?>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/tools-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/'.strtolower($site::$convert_to).'-bit.php');?>
        <br>
        <br>
        <?php include('cards/dbf-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="footContainer" class="fitBlock alignCenter">
            <?php include('cards/legal-bit.php');?>
        </div> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
        <script src="jquery.form.js"></script>
        <script>
            (function() {
                var bar = $('.bar');
                var status = $('#status');

                $('form').ajaxForm({
                    beforeSend: function() {
                        bar.width('0%');
                        $('#progressbar').show();
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        bar.width(percentComplete + '%');
                    },
                    success: function() {
                        bar.width('100%');
                    },
                    complete: function(xhr) {
                        status.html(xhr.responseText);
                    }
                });
                $('#progressbar').hide();
            })();
        </script>
        <?php include('js/shareaholic.php');?>
        <?php include('js/google_analytics.php');?>
    </body>
</html>
