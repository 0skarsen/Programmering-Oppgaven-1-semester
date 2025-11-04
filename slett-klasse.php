<?php
  print ("<h3>Slett klasse</h3>");
?>

<script src="funksjoner.js"></script>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klassekode <select name="Klassekode" id="Klassekode" required>
    <option value="">Velg klassekode</option>
<?php
  include("db-tilkobling.php");
  $sqlSetning="SELECT * FROM Klasseliste ORDER BY Klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

  while ($rad = mysqli_fetch_array($sqlResultat)) {
    $klassekode = $rad["Klassekode"];
    $klasseliste = $rad["Klasseliste"];
    print("<option value='$klassekode'>$klassekode - $klasseliste</option>");
  }
?>
  </select> <br/>
  <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];

      if (!$Klassekode)
        {
          print ("Klassekode m&aring; velges");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          // Check if class has students
          $sqlSetning="SELECT * FROM Student WHERE Klassekode='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallStudenter=mysqli_num_rows($sqlResultat);

          if ($antallStudenter > 0)
            {
              print ("Kan ikke slette klasse som har studenter registrert");
            }
          else
            {
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
    }
?>
