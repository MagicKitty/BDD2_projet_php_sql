<!DOCTYPE html>
<html>
  <head>
    <title author='rohr ludovic'>Projet S4</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h2 color='blue'><b><center>Bienvenue sur l'application d'interogation de la BDD</center></b></h2>
    <h3>Que voulez-vous ? </h3>
    <h4> &nbsp;A)Liste des oeuvres qui ont pour thème :</h4>
    
    <?php
    $conn = oci_connect("etud003", "oracle", "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))");
    
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $stid = oci_parse($conn, 'SELECT libelle FROM theme');
    
    if(!$stid){
      $e=oci_error($conn);
      print($e['message']);
      exit;
    }
    
    oci_execute($stid);
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

    <form method="post" action="projet.php">

    <p> Thème : <select name="theme">
    <?php
    while($option = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS)) {
      $lib = $option['LIBELLE'];
      echo "<option value=\"$lib\">$lib</option>\n";
    }
    ?>
    </select>

    <input type="submit" value="Chercher" title="Valider pour chercher une oeuvre selon le thème" />

    </p>
    </form>
    
    <?php
    if( isset($_POST['theme']) && !empty($_POST['theme'])) {
      $th = $_POST['theme'];
      $q = "SELECT titre FROM Oeuvre NATURAL JOIN Apourtheme WHERE libelle = '$th'";
      $rep = connection($conn,$q);
      echo"<p>Voici les films qui ont pour thème : $th</p>";
      echo "<table border='1'>\n";
      while ($repo = oci_fetch_array($rep, OCI_ASSOC+OCI_RETURN_NULLS)) {
	echo "<tr>\n";
	foreach ($repo as $it) {
	  echo "<td>" . ($it !== null ? htmlentities($it, ENT_QUOTES) : "") . "</td>\n";
	}
	echo "</tr>\n";
      }
      echo "</table>\n";
    }
    ?>

    <?php
    $or = oci_parse($conn, 'SELECT nom FROM Lieu');
    if(!$or) {
      $e=oci_error($conn);
      print($e['message']);
      exit;
    }
    oci_execute($or);
    ?>
    
    <h4> &nbsp;B) Liste des oeuvres ayant pour origine : </h4>
    <form method="post" action="projet.php">
    <p> Origine : <select name="Origine">
    <?php
    while($opt = oci_fetch_array($or,OCI_ASSOC+OCI_RETURN_NULLS)) {
      $ori = $opt['NOM'];
      echo "<option value=\"$ori\">$ori</option>\n";
    }
    ?>
	
    <input type="submit" value="Chercher" title="Valider pour chercher une oeuvre selon l'origine" />
    </select>
    </p>
    </form>

    <?php
    if( isset($_POST['Origine']) && !empty($_POST['Origine'])) {
      $ori = $_POST['Origine'];
      $req = "SELECT titre FROM Oeuvre o JOIN lieu ON 
	       o.nom = lieu.nom
	       WHERE lieu.nom = '$ori' OR lieu.nom_continent = '$ori' ";

      echo"<p>Voici les oeuvres qui on pour origine : $ori</p>";
      $rep=connection($conn, $req);
      echo "<table border='1'>\n";
      while ($repo = oci_fetch_array($rep, OCI_ASSOC+OCI_RETURN_NULLS)) {
	echo "<tr>\n";
	foreach ($repo as $it) {
	  echo "    <td>" . ($it !== null ? htmlentities($it, ENT_QUOTES) : "") . "</td>\n";
	}
	echo "</tr>\n";
      }
      echo "</table>\n";
    }
    ?>
    
    <p>
    <h4> &nbsp;C) Nombre d'oeuvre(s) musicale par genre : </h4>

    <form method="post" action ="questionC.php">

    <input type="submit" name="nombre" value="Afficher"  title="Cliquez pour afficher le nombre d'oeuvre musicale par genre" />

    </form>

    <h4> &nbsp;D) Nombre d'oeuvre(s) par types et origine : </h4>

    <form method="post" action ="questionD.php">

    <input type="submit" name="nbpteo" value="Afficher"  title="Cliquez pour afficher le nombre d'oeuvre par type et par origine" />

    </form>
    </p>
    
    <?php
    oci_close($conn);
    ?>

    <br><br><p><form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/partie2.html">

    <input type="submit" name="jlkjlk" value="Vers page d'ajout" title="Cliquez ici pour accedez a la pages d'ajout d'oeuvre dans la BDD"/>
    </form></p>
  </body>
</hmtl>
