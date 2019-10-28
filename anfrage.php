<html>
<body>
<?php
   $con = mysqli_connect("","root");
   mysqli_select_db($con, "projekt_construct_manager");

   echo "<b>Alle Personen:</b><br />";
   $res = mysqli_query($con, "select * from bacteria2 order by pe_nachname, pe_vorname");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["pe_nachname"] . ", " . $dsatz["pe_vorname"] . "<br />";

   echo "<br /><b>Anzahl der Kunden:</b><br />";
   $res = mysqli_query($con, "select count(ku_id) as count_ku_id from kunde");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["count_ku_id"] . "<br />";

   echo "<br /><b>Alle Kunden mit allen Projekten:</b><br />";
   $res = mysqli_query($con, "select * from kunde, projekt "
     . "where ku_id = pr_ku_id order by ku_name, ku_ort, pr_bezeichnung");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["ku_name"] . ", " . $dsatz["ku_ort"] . ", " . $dsatz["pr_bezeichnung"] . "<br />";

   echo "<br /><b>Alle Personen mit allen Projektzeiten:</b><br />";
   $res = mysqli_query($con, "select * from projekt, projekt_person, person "
     . "where projekt.pr_id = projekt_person.pr_id "
     . "and projekt_person.pe_id = person.pe_id "
     . "order by pe_nachname, pr_bezeichnung, pp_datum");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["pe_nachname"] . ", " . $dsatz["pr_bezeichnung"]
         . ", " . $dsatz["pp_datum"] . "<br />";

   echo "<br /><b>Alle Personen mit Zeitsumme:</b><br />";
   $res = mysqli_query($con, "select pe_nachname, sum(pp_zeit) as sum_pp_zeit "
     . "from person, projekt_person "
     . "where person.pe_id = projekt_person.pe_id "
     . "group by person.pe_id, pe_nachname "
     . "order by pe_nachname");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["pe_nachname"] . ", " . $dsatz["sum_pp_zeit"] . "<br />";

   echo "<br /><b>Alle Projekte mit allen Personenzeiten:</b><br />";
   $res = mysqli_query($con, "select * from projekt, projekt_person, person "
     . "where projekt.pr_id = projekt_person.pr_id "
     . "and projekt_person.pe_id = person.pe_id "
     . "order by pr_bezeichnung, pe_nachname, pp_datum");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["pr_bezeichnung"] . ", " . $dsatz["pe_nachname"]
         . ", " . $dsatz["pp_datum"] . "<br />";

   echo "<br /><b>Alle Projekte mit Zeitsumme:</b><br />";
   $res = mysqli_query($con, "select pr_bezeichnung, sum(pp_zeit) as sum_pp_zeit "
     . "from projekt, projekt_person "
     . "where projekt.pr_id = projekt_person.pr_id "
     . "group by projekt.pr_id, pr_bezeichnung "
     . "order by pr_bezeichnung");
   while ($dsatz = mysqli_fetch_assoc($res))
      echo $dsatz["pr_bezeichnung"] . ", " . $dsatz["sum_pp_zeit"] . "<br />";

   mysqli_close($con);
?>
</body>
</html>
