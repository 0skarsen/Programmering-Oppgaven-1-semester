<?php
  print ("<h3>Slett student</h3>");
?>

<script src="funksjoner.js"></script>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
  Student <select name="Student" id="Student" required>
    <option value="">Velg student</option>
<?php
  include("db-tilkobling.php");
  $sqlSetning="SELECT * FROM Student ORDER BY Student;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

  while ($rad = mysqli_fetch_array($sqlResultat)) {
    $klassekode = $rad["Klassekode"];
    $student = $rad["Student"];
    print("<option value='$klassekode|$student'>$student ($klassekode)</option>");
  }
?>
  </select> <br/>
  <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
  if (isset($_POST ["slettStudentKnapp"]))
    {
      $studentData = $_POST ["Student"];
      list($Klassekode, $Student) = explode("|", $studentData);

      if (!$Student)
        {
          print ("Student m&aring; velges");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Student WHERE Klassekode='$Klassekode' AND Student='$Student';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat);

          if ($antallRader==0)  /* student finnes ikke */
            {
              print ("Student finnes ikke");
            }
          else
            {
              $sqlSetning="DELETE FROM Student WHERE Klassekode='$Klassekode' AND Student='$Student';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende student er n&aring; slettet: $Student ($Klassekode)");
            }
        }
    }
?>
