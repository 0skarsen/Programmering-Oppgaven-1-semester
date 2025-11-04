<?php  /* slett-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett Student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
  Postnr <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  <input type="submit" value="Slett Student" name="slettStudentKnapp" id="slettStudentKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettStudentKnapp"]))
    {	
      $Klassekode=$_POST ["Klassekode"];
	  
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
              $sqlSetning="DELETE FROM Student WHERE Klassekode='$Klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende Student er n&aring; slettet: $Klassekode <br />");
            }
        }
    }
?> 