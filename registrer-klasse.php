<?php
  print ("<h3>Registrer klasse</h3>");
?>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Klasseliste <input type="text" id="Klasseliste" name="Klasseliste" required /> <br/>
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $Klasseliste=$_POST ["Klasseliste"];

      if (!$Klassekode || !$Klasseliste)
        {
          print ("B&aring;de Klassekode og Klasseliste m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klasseliste WHERE Klassekode='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat);

          if ($antallRader!=0)  /* klasse er registrert fra før */
            {
              print ("Klasse er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klasseliste VALUES('$Klassekode','$Klasseliste');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klasse er n&aring; registrert: $Klassekode $Klasseliste");
            }
        }
    }
?>
