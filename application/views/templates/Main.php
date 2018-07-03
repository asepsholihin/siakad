<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title>SISTEM AKADEMIK</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/default.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery-editable.min.css" rel="stylesheet"/>
</head>

<body class="fix-header">
    
    <div id="wrapper">
        
        <?php echo $header; ?>
        
        <div id="page-wrapper">
            <?php echo $content; ?>
            
            <?php echo $footer; ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.poshytip.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-editable-poshytip.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>
