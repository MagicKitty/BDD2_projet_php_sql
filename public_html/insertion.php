<html>
<head>
<meta charset="utf-8"/>
<title>Projet S4 insertion</title>
 <style>
    body{
      background-color:#333;
      color:#1CECB9;
    
    
    }
    h2
    {
    font-size:xx-large;
    color:#1CECB9;
    font-family:Avantgarde, sans-serif;
    -moz-border-radius:180px;
    -webkit-border-radius:180px;
    border-radius:180px;
    border: 2px double #9b9b9b;
    -moz-box-shadow: inset 1px 1px 20px 1px #67fd9a;
    -webkit-box-shadow: inset 1px 1px 20px 1px #67fd9a;
    -o-box-shadow: inset 1px 1px 20px 1px #67fd9a;
    box-shadow: inset 1px 1px 20px 1px #67fd9a;
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#67fd9a, Direction=134, Strength=20);
    -moz-border-radius: 75px;
    -webkit-border-radius: 75px;
    border-radius: 75px;
    
    }
    h4{
      color:#CE6656;
      box-shadow: 0px 5px 9px 0px #ffffff;
      border-radius: 13px;
      width:400px;
      margin-left:15px;
    
    
    
    
    }
    p{
      margin-left:40px;
    
    
    
    
    }
    input{
    color:#343434;
    bg-color:blue;
    margin-left:40px;
    }
    table{
      margin-left:40px;
    
    }
    tr{
      margin-left:40px;
    }
    </style>
</head>
<body>

<h2><center>Bienvenue sur le menu d'insertion de la base de données</center></h2>
<h3>Application d'insertion dans la base de données : </h3>

<h4>&nbsp;Selectionner  le type d'oeuvre : </h4>
<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">

<p> Types d'oeuvre : <select name="type">


  <option value="Livre">Livre</option>
  <option value="Oeuvre_musicale">Oeuvre musicale</option>
  <option value="Film">Film</option>
	<input type="submit" value="Chercher" title="Valider pour chercher une oeuvre selon l'origine" />
</select>
</form>
<?php
$conn = oci_connect("etud003", "oracle", "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))");
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
if( isset($_POST['type']) && !empty($_POST['type'])){
  $pos=$_POST['type'];
  if($pos=="Livre"){
    echo'<h4>&nbsp;Livre</h4>';
    
    echo' <p>Titre : <input type="text" name="titre" method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php /> </p>';
    $or = oci_parse($conn, 'SELECT nom FROM lieu');


if(!$or){
	$e=oci_error($conn);
	print($e['message']);
	exit;
}
oci_execute($or);
$lg=oci_parse($conn,'SELECT DISTINCT langue FROM oeuvre');
oci_execute($lg);
$ep=oci_parse($conn,'SELECT DISTINCT epoque FROM oeuvre');
oci_execute($ep);
$th=oci_parse($conn,'SELECT DISTINCT libelle FROM theme');
oci_execute($th);
$ge=oci_parse($conn,'SELECT DISTINCT nom FROM genre');
oci_execute($ge);
$t=$_POST['titre'];
if( isset($_POST['titre']) && !empty($_POST['titre'])){

echo $t;
}

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Origine : <select name="Origine">';


   
	while($opt = oci_fetch_array($or,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$ori = $opt['NOM'];
	echo "<option value=\"$ori\">$ori</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<p>Date Création : 
  Jour <SELECT name="Jour">
    <option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
  </SELECT> Mois <SELECT name="Mois">
    <option></option><option>JAN</option><option>FEB</option><option>MAR</option><option>APR</option><option>MAY</option><option>JUN</option><option>JUL</option><option>AUG</option><option>SEP</option><option>OCT</option><option>NOV</option><option>DEC</option>
  </SELECT>
  Année <INPUT type="text" name="Année" size="2"></p>';
  
  echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Langue : <select name="Langue">';


   
	while($opt = oci_fetch_array($lg,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$lan = $opt['LANGUE'];
	echo "<option value=\"$lan\">$lan</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';


echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Epoque : <select name="Epoque">';


   
	while($opt = oci_fetch_array($ep,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$epo = $opt['EPOQUE'];
	echo "<option value=\"$epo\">$epo</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Thème : <select name="theme">';


   
	while($opt = oci_fetch_array($th,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$li = $opt['LIBELLE'];
	echo "<option value=\"$li\">$li</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Genre : <select name="genre">';


   
	while($opt = oci_fetch_array($ge,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$f = $opt['NOM'];
	echo "<option value=\"$f\">$f</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';
    echo'<br><br><p><form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';
    echo'<input type="submit" value="Retour insertion oeuvre" title="Retourner vers la page de recherche" name="retour"/>';
    echo'</form></p>';
  }
  if($pos=="Film"){
     echo'<h4>&nbsp;Film</h4>';
    
      echo' <p>Titre : <input type="text" name="pseudo" /> </p>';
   
      $or = oci_parse($conn, 'SELECT nom FROM lieu');


if(!$or){
	$e=oci_error($conn);
	print($e['message']);
	exit;
}
oci_execute($or);
$lg=oci_parse($conn,'SELECT DISTINCT langue FROM oeuvre');
oci_execute($lg);
$ep=oci_parse($conn,'SELECT DISTINCT epoque FROM oeuvre');
oci_execute($ep);
$th=oci_parse($conn,'SELECT DISTINCT libelle FROM theme');
oci_execute($th);
$ge=oci_parse($conn,'SELECT DISTINCT nom FROM genre');
oci_execute($ge);
$t=$_POST['titre'];
if( isset($_POST['titre']) && !empty($_POST['titre'])){

echo $t;
}

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Origine : <select name="Origine">';


   
	while($opt = oci_fetch_array($or,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$ori = $opt['NOM'];
	echo "<option value=\"$ori\">$ori</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<p>Date Création : 
  Jour <SELECT name="Jour">
    <option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
  </SELECT> Mois <SELECT name="Mois">
    <option></option><option>Janvier</option><option>Février</option><option>Mars</option><option>Avril</option><option>Mai</option><option>Juin</option><option>Juillet</option><option>Aout</option><option>Septembre</option><option>Octobre</option><option>Novembre</option><option>Décembre</option>
  </SELECT>
  Année <INPUT type="text" name="Année" size="2"></p>';
  
  echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Langue : <select name="Langue">';


   
	while($opt = oci_fetch_array($lg,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$lan = $opt['LANGUE'];
	echo "<option value=\"$lan\">$lan</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';


echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Epoque : <select name="Epoque">';


   
	while($opt = oci_fetch_array($ep,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$epo = $opt['EPOQUE'];
	echo "<option value=\"$epo\">$epo</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Thème : <select name="theme">';


   
	while($opt = oci_fetch_array($th,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$li = $opt['LIBELLE'];
	echo "<option value=\"$li\">$li</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Genre : <select name="genre">';


   
	while($opt = oci_fetch_array($ge,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$f = $opt['NOM'];
	echo "<option value=\"$f\">$f</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';
    echo'<br><br><p><form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';
    echo'<input type="submit" value="Retour insertion oeuvre" title="Retourner vers la page de recherche" name="retour"/>';
    echo'</form></p>';
  }
  if($pos=="Oeuvre_musicale"){
   echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';
    echo'<h4>&nbsp;Oeuvre musicale</h4>';
    
    echo' <p>Titre : <input type="text" name="pseudo" /> </p>';
   
      $or = oci_parse($conn, 'SELECT nom FROM lieu');


if(!$or){
	$e=oci_error($conn);
	print($e['message']);
	exit;
}
oci_execute($or);
$lg=oci_parse($conn,'SELECT DISTINCT langue FROM oeuvre');
oci_execute($lg);
$ep=oci_parse($conn,'SELECT DISTINCT epoque FROM oeuvre');
oci_execute($ep);
$th=oci_parse($conn,'SELECT DISTINCT libelle FROM theme');
oci_execute($th);
$ge=oci_parse($conn,'SELECT DISTINCT nom FROM genre');
oci_execute($ge);
$t=$_POST['titre'];
if( isset($_POST['titre']) && !empty($_POST['titre'])){

echo $t;
}

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Origine : <select name="Origine">';


   
	while($opt = oci_fetch_array($or,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$ori = $opt['NOM'];
	echo "<option value=\"$ori\">$ori</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<p>Date Création : 
  Jour <SELECT name="Jour">
    <option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
  </SELECT> Mois <SELECT name="Mois">
    <option></option><option>Janvier</option><option>Février</option><option>Mars</option><option>Avril</option><option>Mai</option><option>Juin</option><option>Juillet</option><option>Aout</option><option>Septembre</option><option>Octobre</option><option>Novembre</option><option>Décembre</option>
  </SELECT>
  Année <INPUT type="text" name="Année" size="2"></p>';
  
  echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Langue : <select name="Langue">';


   
	while($opt = oci_fetch_array($lg,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$lan = $opt['LANGUE'];
	echo "<option value=\"$lan\">$lan</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';


echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Epoque : <select name="Epoque">';


   
	while($opt = oci_fetch_array($ep,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$epo = $opt['EPOQUE'];
	echo "<option value=\"$epo\">$epo</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Thème : <select name="theme">';


   
	while($opt = oci_fetch_array($th,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$li = $opt['LIBELLE'];
	echo "<option value=\"$li\">$li</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

echo'<form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';

echo'<p> Genre : <select name="genre">';


   
	while($opt = oci_fetch_array($ge,OCI_ASSOC+OCI_RETURN_NULLS))
	{
     	
	$f = $opt['NOM'];
	echo "<option value=\"$f\">$f</option>\n";
	}


	
	
	
echo'</select>';
echo'</p>';
echo'</form>';

    echo'</form>';
    
    echo'<br><br><p><form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/insertion.php">';
    echo'<input type="submit" value="Retour insertion oeuvre" title="Retourner vers la page de recherche" name="retour"/>';
    echo'</form></p>';
    
  }
}
echo'<br><br><p><form method="post" action="https://ens-bdd.fst.site.univ-lorraine.fr/~blin5u/projet.php">';
echo'<input type="submit" value="Retour" title="Retour vers la page de projet " name="retour"/>';
echo'</form></p>';

?>
<?php oci_close($conn); ?>
</body>

</html>