<?php
require_once('bootstrap.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta name="keywords" content="<?=DBF_To_Common::$meta_keywords?>,<?=$site::$meta_keywords?>">
    <meta name="description" content="<?=$site::$meta_description?>">
    <meta name="revisit-after" content="3 days">
    <meta name="Content-Language" content="english">
    <meta name="robots" content="index,all">
    <meta name="distribution" content="Global">
    <meta name="msvalidate.01" content="<?=$site::$meta_msvalidate?>" />
    <meta name="google-site-verification" content="<?=$site::$meta_google_site_verification?>" />
    <title><?=$site::$site_title?></title>
    <link href="/dbfto.css" rel="stylesheet" type="text/css">
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
        <div class="subline">Convert all you DBF data to <?=$site::$convert_to?> free in 3 easy steps.</div>
        <div style="height:2px;"></div>
        <div class="subline">Step 1.</div>
        <div class="content">&nbsp;Choose your .dbf dbase database file to convert, up to 100mb.</div>
        <div class="subline">Step 2.</div>
        <div class="content">&nbsp;Upload your file.</div>
        <div class="subline">Step 3.</div>
        <div class="content">&nbsp;Download you data as <?=$site::$convert_to?>.</div>
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
        <div class="card auto-grid-cell">
	<div class="card-area alignCenter">
        <div class="alignCenter legal-card"><br>
            <span class="legalline">DBFto<?=$site::$convert_to?> - A Service By Shawn Lawyer</span><br><br>
            <span class="caption">
                shawnlawyer@gmail.com - +1.718.864.2801 - 331 Wilson Ave Swannanoa NC 28778<br>
                Computer Software Design &amp; Computer Programming Services<br><br>
            </span>
        </div>
    </div>
</div>
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
    <script type="text/javascript">
//<![CDATA[
  (function() {
    var shr = document.createElement('script');
    shr.setAttribute('data-cfasync', 'false');
    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
    shr.type = 'text/javascript'; shr.async = 'true';
    shr.onload = shr.onreadystatechange = function() {
      var rs = this.readyState;
      if (rs && rs != 'complete' && rs != 'loaded') return;
      var site_id = '<?=$site::$shareaholic_id?>';
      try { Shareaholic.init(site_id); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(shr, s);
  })();
//]]>
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?=$site::$google_analytics_id?>', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
