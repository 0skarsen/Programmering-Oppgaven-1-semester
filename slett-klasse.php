<?php
  print ("<h3>Slett klasse</h3>");
?>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];

      if (!$Klassekode)
        {
          print ("Klassekode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klasseliste WHERE Klassekode='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat);

          if ($antallRader==0)  /* klasse finnes ikke */
            {
              print ("Klasse finnes ikke");
            }
          else
            {
              $sqlSetning="DELETE FROM Klasseliste WHERE Klassekode='$Klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klasse er n&aring; slettet: $Klassekode");
            }
        }
    }
?>
