<?php  /* endre-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal endres  
/*  Programmet endrer det valgte poststedet
*/
?> 

<h3>Endre Student</h3>

<form method="post" action="" id="finnStudentSkjema" name="finnStudentSkjema">
  Postnr <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Poststed (ny verdi)<input type="text" id="Student" name="Student" required /> <br/>
  <input type="submit"  value="Endre Student" name="endreStudentKnapp" id="endreStudentKnapp"> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["endreStudentKnapp"]))
    {	
      $Klassekode=$_POST ["Klassekode"];
      $Student=$_POST ["Student"];
	  
	  if (!$Klassekode)
        {
          print ("Klassekode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Student WHERE Klassekode='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Student finnes ikke");
            }
          else
            {	  	  
              $sqlSetning="UPDATE Student SET Student='$Student' WHERE Klassekode='$Klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
                /* SQL-setning sendt til database-serveren */
			
              print ("Student med Klassekode $Klassekode er n&aring; endret<br />");
            }
        }
    }
?> 