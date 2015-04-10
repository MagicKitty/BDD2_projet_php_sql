<!DOCTYPE html>
<html>
  <head>
    <title author='rohr ludovic'>Projet S4</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <h2 color='blue'><b><center> &nbsp;C) Nombre d'oeuvre(s) musicale par genre : </center></b></h2>

<?php
    $conn = oci_connect("etud003", "oracle", "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))");
    
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
      $req_genre = "SELECT Apourgenre.nom_genre,COUNT(Oeuvre_musicale.titre) FROM Oeuvre_musicale JOIN Apourgenre ON Apourgenre.titre = Oeuvre_musicale.titre GROUP BY Apourgenre.nom_genre";
      $xyz = connection($conn,$req_genre);
      print '<table border="1">';
      print '<tr><td>Genres</td><td>Nombre</td></tr>';

      while ($z = oci_fetch_array($xyz, OCI_ASSOC+OCI_RETURN_NULLS)) {
	print '<tr>';
	foreach ($z as $it) {
	  print '<td>'.($it !== null ? htmlentities($it, ENT_QUOTES) : '').'</td>';
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