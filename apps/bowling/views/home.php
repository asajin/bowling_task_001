<?php
$params = &View::$params;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Bowling</title>
<!-- add your meta tags here -->

<link rel="stylesheet" href="css/basemod.css" type="text/css"/>

</head>
<body>
  <div class="page_margins">
    <div class="page">
      <div id="header">
        <div id="topnav">
          <!-- start: skip link navigation -->
          <a href="#">Bowling</a> | <a href="?q=sortie&do=item&id=1">Affichage sortie bowling</a> | <a href="#">Login</a>
        </div>
      </div>
      <div id="main">
        <div id="col1">
          <div id="col1_content" class="clearfix">
            Bowling <b><? echo $params['nom'] ?></b>
          </div>
        </div>
      </div>
      <!-- begin: #footer -->
      <div id="footer"></div>
    </div>
  </div>
</body>
</html>
