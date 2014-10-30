<?php
require_once('bootstrap.php');
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php include('cards/head-tags.php');?>
    </head>
    <body class="alignCenter">
        <div id="headContainer" class="fitBlock">
            <div class="site-header">DBF to</div>
        </div>  
        <br>
        <br>  
        <br>
        <br>  
        <br>
        <br>
        <br>
        <br> 
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
            <div class="subline">Convert all you DBF data to JSON, XML, and CSV free in 3 easy steps.</div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="headline">Step 1</div>
        <br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="subline">Choose a dBase DBF file to convert. Up to 100mb for free.</div>
            </div>
            <br> 
            <br> 
            <br>
            <div class="headline">Step 2</div>
            <br>
            <div class="card">
                <div class="subline">Upload your dBase DBF file!</div>
            </div>
        </form>
        <br>
        <br> 
        <div class="headline">Step 3</div>
        <br>
        <div class="card" id="status">
            <div class="subline">Grab your converted dBase DBF data as JSON, XML, and CSV!</div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/tools-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <?=$site::$google_ad_block_2?>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/related-bit.php');?>
        <br>
        <br>
        <br>
        <br>
        <?php include('cards/vpf-bit.php');?>
        <br>
        <br>
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
        <?php include('js/shareacolic.php');?>
        <?php include('js/google_analytics.php');?>

    </body>
</html>
