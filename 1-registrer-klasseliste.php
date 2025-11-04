<?php  /* registrer-poststed */
/*
/*  Programmet lager et html-skjema for å registrere et poststed
/*  Programmet registrerer data (postnr og poststed) i databasen
*/
?> 

<h3>Registrer Klasseliste </h3>

<form method="post" action="" id="registrerKlasselisteSkjema" name="registrerKlasselisteSkjema">
  Postnr <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Poststed <input type="text" id="Klasseliste" name="Klasseliste" required /> <br/>
  <input type="submit" value="Registrer Klasseliste" id="registrerKlasselisteKnapp" name="registrerKlasselisteKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlasselisteKnapp"]))
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

          $sqlSetning="SELECT * FROM Klasseliste WHERE Klassekode='$Klasseliste';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* poststedet er registrert fra før */
            {
              print ("Klasseliste er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO poststed VALUES('$Klassekode','$Klasseliste');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende poststed er n&aring; registrert: $Klassekode $Klasseliste"); 
            }
        }
    }
?> 