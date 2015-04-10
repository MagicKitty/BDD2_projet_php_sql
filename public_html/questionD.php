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
      $music = "Oeuvre_Musicale";
      $film = "Film";
      $origin = "Lieu";
      $xyz = connection($conn,$req_liv);
      print '<table border="1">';
      print '<tr><td></td><td>'.$livre.'</td><td>'.$music.'</td><td>'.$film.'</td></tr>';
      
      $req_ori = "SELECT nom FROM $origin";
      $abc = connection($conn,$req_ori);

      while ($z = oci_fetch_array($abc, OCI_RETURN_NULLS)) {
	
	print '<tr>';
	  print '<td>'.$z[0].'</td>';
	  $req_co = "SELECT count(titre) FROM $livre JOIN Oeuvre USING (titre) JOIN $origin USING (nom) WHERE nom LIKE '$z[0]'";
	  $rep = oci_parse($conn, $req_co);
	  oci_execute($rep);
	  $res = oci_fetch_array($rep, OCI_RETURN_NULLS);
	   print '<td>'.$res[0].'</td>';

	  $req_con = "SELECT count(titre) FROM $music JOIN Oeuvre USING (titre) JOIN $origin USING (nom) WHERE nom LIKE '$z[0]'";
	  $rep = oci_parse($conn, $req_con);
	  oci_execute($rep);
	  $res = oci_fetch_array($rep, OCI_RETURN_NULLS);
	   print '<td>'.$res[0].'</td>';

	  $req_cone = "SELECT count(titre) FROM $film JOIN Oeuvre USING (titre) JOIN $origin USING (nom) WHERE nom LIKE '$z[0]'";
	  $rep = oci_parse($conn, $req_cone);
	  oci_execute($rep);
	  $res = oci_fetch_array($rep, OCI_RETURN_NULLS);
	   print '<td>'.$res[0].'</td>';

	   $i = $i + 1;
	   
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