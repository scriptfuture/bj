<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
	<link href="/frontend/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<link rel="stylesheet/less" type="text/css" href="/frontend/less/main.less" />

  </head>

  <body>
  
<?php

// меню
include_once("blocks/menu.php");
?>
  
    <div class="container">
        <?php include($subtpl); ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <script src="/frontend/js/jquery-2.1.4.min.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
	
    <script src="/frontend/js/less-1.7.3.min.js"></script>
	
    <script src="/frontend/js/ui.js"></script>

  </body>
</html>