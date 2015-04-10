<!DOCTYPE html>
<html>
  <head>
    <title author='rohr ludovic'>Projet S4</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <h2 color='blue'><b><center> &nbsp;D) Nombre d'oeuvre(s) par type et par origine : </center></b></h2>

<?php
    $conn = oci_connect("etud005", "oracle", "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))");
    
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    ?>

<?php
    function connection($connex, $q) {
      $rep = @oci_parse($connex, $q);
      if (!$rep){
	$e = @oci_error($connex);
	print($e['message']);
	exit;
      }
      $x = @oci_execute($rep);
      if (!$x){
	$e = @oci_error($rep);
	echo($e['message']);
	exit;
      }
      return $rep;
    }
    ?>


<?php
      $livre = "Livre";
      $music = "Oeuvre Musicale";
      $film = "Film";
      $origin = "Lieu";
      $xyz = connection($conn,$req_liv);
      print '<table border="1">';
      print '<tr><td></td><td>'.$livre.'</td><td>'.$music.'</td><td>'.$film.'</td></tr>';
      
      $req_ori = "SELECT nom FROM $origin";
      $abc = connection($conn,$req_ori);
      
      while ($z = oci_fetch_array($abc, OCI_ASSOC+OCI_RETURN_NULLS)) {
	print '<tr>';
	foreach ($z as $it) {
	  print '<td>'.($it !== null ? htmlentities($it, ENT_QUOTES) : '').'</td>';
	}
	if (count($z)==count($abc)) {
	  $req_co = "SELECT count(titre) FROM $livre JOIN Oeuvre USING titre WHERE Oeuvre.nom = $z[0]";
	  $rep = oci_parse($conn, $req_co);
	  oci_execute($rep);
	  $res = oci_fetch_array($rep, OCI_ASSOC+OCI_RETURN_NULLS);
	  print '<td>'.$res.'</td>';
	}
	if (count($z)==count($abc)) {
	  print '<td></td>';
	}
	if (count($z)==count($abc)) {
	  print '<td></td>';
	}
	print '</tr>';
      }
      
      print '</table>';
      
      print '</br>';
    ?>
    
    <form method="post" action ="projet.php">

    <input type="submit" name="nombre" value="Retour"  title="Cliquez pour revenir sur l'interrogation de la BDD" />

    </form>
    
  </body>
</html>