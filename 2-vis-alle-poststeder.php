<?php  /* vis-alle-poststeder */
/*
/*  Programmet skriver ut alle registrerte poststeder
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utf�rt og valg av database foretatt */

  $sqlSetning="SELECT * FROM Student;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte Student</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>postnr</th> <th align=left>poststed</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra sp�rringsresultatet */
      $Klassekode=$rad["Klassekode"];        /* ELLER $postnr=$rad[0]; */
      $Student=$rad["Student"];    /* ELLER $poststed=$rad[1]; */

      print ("<tr> <td> $Klassekode </td> <td> $Student </td> </tr>");
    }
  print ("</table>"); 
?>