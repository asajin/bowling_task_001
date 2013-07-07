<?php
$params = &View::$params;

//var_dump($params['parties']);
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
            Bowling on <? echo $params['sortie']['date'] ?><br />
            - nom : <b><? echo $params['sortie']['nom'] ?></b><br />
            - adresse : <b><? echo $params['sortie']['adresse'] ?></b><br />
            <a href="#">fiche bowling</a>
            <?php foreach($params['parties']['coups'] as $partie_id => $partie): ?>
            <table border="1">
              <tr>
                <td>Partie # <? echo $partie_id; ?></td>
                <?php for($i=1;$i<=10;$i++): ?>
                <td style="width:40px"><? echo $i; ?></td>
                <?php endfor; ?>
                <td>Total</td>
                <td>Total Cumul</td>
              </tr>
              <?php foreach($params['parties']['coups'][$partie_id] as $joueur_id => $coup): ?>
              <tr>
                <td><? echo $params['parties']['joueurs'][$joueur_id]['joueur_alias']; ?></td>
                <?php for($i=1;$i<=10;$i++): ?>
                <td><? if(isset($coup[$i])) echo $coup[$i]['coup_score']; else echo '&nbsp;'; ?></td>
                <?php endfor; ?>
                <td><? echo $params['parties']['joueur_total'][$partie_id][$joueur_id]; ?></td>
                <td><? echo $params['parties']['joueur_total_cumul'][$joueur_id]; ?></td>
              </tr>
              <?php endforeach; ?>
            </table><br>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <!-- begin: #footer -->
      <div id="footer"></div>
    </div>
  </div>
</body>
</html>
