<?php  /* endre-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal endres  
/*  Programmet endrer det valgte poststedet
*/
?> 

<h3>Endre Klasseliste</h3>

<form method="post" action="" id="finnKlasselisteSkjema" name="finnKlasselisteSkjema">
  Postnr <input type="text" id="klassekode" name="klassekode" required /> <br/>
  Poststed (ny verdi)<input type="text" id="Klasseliste" name="Klasseliste" required /> <br/>
  <input type="submit"  value="Endre Klasseliste" name="endreKlasselisteKnapp" id="endreKlasselisteKnapp"> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["endreKlasselisteKnapp"]))
    {	
      $Klassekode=$_POST ["Klassekode"];
      $Klasseliste=$_POST ["Klasseliste"];
	  
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

          if ($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Klasseliste finnes ikke");
            }
          else
            {	  	  
              $sqlSetning="UPDATE poststed SET Klasseliste='$Klasseliste' WHERE Klassekode='$Klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
                /* SQL-setning sendt til database-serveren */
			
              print ("Klasseliste med Klassekode $Klassekode er n&aring; endret<br />");
            }
        }
    }
?> 