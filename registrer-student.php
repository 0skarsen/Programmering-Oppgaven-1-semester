<?php
  print ("<h3>Registrer student</h3>");
?>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Student navn <input type="text" id="Student" name="Student" required /> <br/>
  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $Student=$_POST ["Student"];

      if (!$Klassekode || !$Student)
        {
          print ("B&aring;de Klassekode og Student navn m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Student WHERE Klassekode='$Klassekode' AND Student='$Student';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat);

          if ($antallRader!=0)  /* student er registrert fra før */
            {
              print ("Student er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Student VALUES('$Klassekode','$Student');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende student er n&aring; registrert: $Klassekode $Student");
            }
        }
    }
?>
