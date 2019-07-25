<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/x-icon" href="farmakeio1.jpg"/>
  <title>Αναζήτηση</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://kalipso.math.uoi.gr/bootstrap4/bootstrap.min.css">
  <script src="https://kalipso.math.uoi.gr/bootstrap4/jquery.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/popper.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/tether.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/bootstrap.min.js"></script>
</head>
<style>
table {
background-color:#b3ffb3;
position:relative;
padding:5px;
margin-left:auto;
margin-right:auto;
width:1300px;
top:5px;
border-collapse: collapse;}
table, th, td {
   height:40px;
   text-align:center;
   border: 4px outset #008000;
}
th{height:70px;}
th.a{border-collapse: collapse;}
th.a{width:80px;}
tr:hover{background-color:#80ff80;}
div.browse h2 {
top:350px;
width:80%;
text-align:center;
position: relative;
border: 1px solid black ;
background-color: #b3ffb3;
margin-right:auto;
margin-left:auto;
padding:8px 2px 12px 9px;}
}
ul.pagination { 
display: inline-block;
 padding:0;
 margin:0;
}
ul.pagination li {display: inline;}
ul.pagination li a {
 background-color:#b3ffb3;
 position:relative;
 top:0px; 
 left:567px;
 color: black;
 float: left;
 padding: 10px 15px;
 text-decoration: none;
}
ul.pagination li a.active {
 background-color: #4CAF50;
 color: white;
}
ul.pagination li a:hover:not(.active) {background-color: #80ff80;}
</style>
<body>
<div class="container" style="margin-left:auto;margin-right:auto;margin-top:5px;position:relative;padding:5px 0px 20px 0px;">
  <div class="btn-group btn-group-md">
    <a href="index.php" class="btn btn-success" role="button">Αρχική Σελίδα</a></button>
    <a href="create.php" class="btn btn-success" role="button">Εγκατάσταση Πίνακα</a>
    <a href="question.php" class="btn btn-success" role="button">Απεγκατάσταση Πίνακα</a>
    <a href="insert.php" class="btn btn-success" role="button">Καταχώρηση Προϊόντος</a>
    <a href="browse.php" class="btn btn-success" role="button">Κατάλογος Φαρμάκων</a>
    <a href="search.php" class="btn btn-success" role="button">Αναζήτηση Προϊόντος</a>
</div>
</div>
<?php
include_once('auth.inc');
if (!(isset($_GET['search']) || isset($_POST['search']))) {
?>
<center><h3>Αναζήτηση με βάση την Ημερομηνία Παραλαβής</h3></center>
<FORM ACTION="<?=$_SERVER['PHP_SELF']?>"  METHOD=POST >
<br>
<center><INPUT TYPE="date" NAME="search" value="" required></center>
<br>
<center><INPUT TYPE=SUBMIT NAME="submit" VALUE="Αναζήτηση"></center>
</FORM>
<div class="img" style="position:absolute;top:60px;margin-left: 20px;">
<img src="a.jpg" height="200" width="300">
</div>
<div class="img" style="position:absolute;top:60px;right:20px;">
<img src="a.jpg" height="200" width="300">
</div>
<?php
} else {
?>
<div class="img" style="position:absolute;top:48px;margin-left: 50px;">
<img src="s.jpg" height="145" width="230">
</div>
<div class="img" style="position:absolute;top:48px;right:50px;">
<img src="s.jpg" height="145" width="230">
</div>
<?php
        $link=@mysqli_connect(HOSTER,USER,PASO,DB);
        if (mysqli_connect_errno($link)) {
               echo "<center><br><h4>Error connecting to Db!!</h4><br>".mysqli_connect_error($link)."</center>";
                exit(0);
}
$query = "SELECT * FROM meds";
 if (!@mysqli_query($link,$query)) {
        echo "<center><br><h4>Ο πίνακας δεν έχει εγκατασταθεί!</h4></center> <br>";
        exit();}
if (isset($_POST['search']))
$srch=$_POST['search'];
else if (isset($_GET['search']))
$srch=$_GET['search'];
$query = "select * from meds where delivery_date like '".$srch."%'";
$result=NULL;
 if ( $result=mysqli_query($link,$query) && mysqli_affected_rows($link)!=0 ) {
 echo "<P><center> Βρέθηκαν επιτυχώς ".mysqli_affected_rows($link)." προϊόντα</center> </P>";
echo "<table><thead><tr><th>ID</th><th>BARCODE</th><th>Ονομασία</th><th>mg</th><th>Δραστική Ουσία</th><th>Ημερομηνία Παραλαβής</th><th>Τιμή €</th><th>ΦΠΑ %</th><th>Διαθέσιμα
<th></th><th></th></tr></thead><tbody>";
$limit=10;
if (isset($_GET['offset'])) {
 $off=$_GET['offset'];
}
else
 $off=0;
$result = mysqli_query($link,$query) or die(mysqli_error());
$count=mysqli_num_rows($result);
 /*Δημιουργία paginator*/
 $page_number=ceil($count/$limit);
 if ($count>$page_number*$limit)
        $page_number++;
 echo "<ul class=\"pagination\">";
 echo "<li> <a href=\"search_date.php?search=$srch&offset=0\">Πρώτο</a></li>";
 for ($i=0;$i<$page_number;$i++) {
        $mf=$i*$limit;
        $num=$i+1;
        if ($off>=$i*$limit && $off<($i+1)*$limit)
        echo "<li><a href=\"search_date.php?search=$srch&offset=$mf\"
 class=\"active\">[$num]</a></li>";
        else
        echo "<li><a href=\"search_date.php?search=$srch&offset=$mf\">[$num]</a></li>";
        }
 echo "<li> <a href=\"search_date.php?search=$srch&offset=$mf\">Τελευταίο </a></li>";echo "</ul>";
 $query = "select * from meds where delivery_date like '".$srch."%' limit $off, $limit";
 $result = mysqli_query($link,$query) or die(mysqli_error());
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC )) {
        print "<tr>";
        foreach ($row as $value)
                print "<td>$value</td>";
        print "<td>". "&nbsp;<a href=delete.php?id=".$row['id'].">Delete</a>"."</td>".
               "<td>". "&nbsp;<a href=update.php?id=".$row['id'].">Update</a><br>"."</td></tr>";
 }
echo "</tbody></table>";
 } else {
 echo "<P><center><br><h4>Δεν υπάρχει φάρμακο με αυτή την Ημερομηνία Παραλαβής</h4></br></center></P>";
 }
 mysqli_close($link);
}

?>

</body>
</html>

