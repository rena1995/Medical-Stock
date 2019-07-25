<!doctype html>
<html>
<head>
<link rel="icon" type="image/x-icon" href="farmakeio1.jpg"/>
<title>Κατάλογος Φαρμάκων</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="http://kalipso.math.uoi.gr/bootstrap4/bootstrap.min.css">
  <script src="https://kalipso.math.uoi.gr/bootstrap4/jquery.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/popper.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/tether.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/bootstrap.min.js"></script>
<style>
table {
background-color:#b3ffb3;
position:relative;
padding:5px;
margin-left:auto;
margin-right:auto;
width:1300px;
top:20px;
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
 left:500px;
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
</head>
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
<table><thead><tr><th>ID</th><th>BARCODE</th><th>Ονομασία</th><th>mg</th><th>Δραστική Ουσία</th><th>Ημερομηνία Παραλαβής</th><th>Τιμή €</th><th>ΦΠΑ %</th><th>Διαθέσιμα</th>
<th class="a"></th><th class="a"></th></tr></thead>
<tbody>
<div class="browse">
<?php
include('auth.inc');
$link=@mysqli_connect(HOSTER,USER,PASO,DB);
if (mysqli_connect_errno($link)) {
        echo "<h2><center>Failed to connect -".mysqli_connect_error($link)."</center><br></h2>";
        exit();
}
$limit=10; 
if (isset($_GET['offset']))
 $off=$_GET['offset'];
else
 $off=0;
 /*Μετρηση πλήθους Εγγραφών πίνακα*/
 $query = "SELECT * FROM meds";
 if (!@mysqli_query($link,$query)) {
        echo "<h2><center>Ο πίνακας δεν έχει εγκατασταθεί!</center></h2> <br>";
        exit();
 }
  $result = mysqli_query($link,$query) or die(mysqli_error());
 $count=mysqli_num_rows($result);
  if ( $count==0) {
        echo "<h2><center>Ο πίνακας είναι άδειος!</center></h2> <br>";
        exit();
 } 
/*Δημιουργία paginator*/
 $page_number=ceil($count/$limit);
 if ($count>$page_number*$limit)
 	$page_number++;
 echo "<ul class=\"pagination\">";
 echo "<li> <a href=\"browse.php?offset=0\">Πρώτο </a></li>";
for ($i=0;$i<$page_number;$i++) {
        $mf=$i*$limit;
 	$num=$i+1;
 	if ($off>=$i*$limit && $off<($i+1)*$limit)
 	echo "<li><a href=\"browse.php?offset=$mf\"
 class=\"active\">[$num]</a></li>";
 	else
 	echo "<li><a href=\"browse.php?offset=$mf\">[$num]</a></li>";
 	}
 echo "<li> <a href=\"browse.php?offset=$mf\">Τελευταίο </a></li>";echo "</ul>";
 $query = "SELECT * FROM meds limit $off, $limit";
 $result = mysqli_query($link,$query) or die(mysqli_error());
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC )) {
 	print "<tr>";
 	foreach ($row as $value)
 		print "<td>$value</td>";
 	print "<td>". "&nbsp;<a href=delete.php?id=".$row['id'].">Delete</a>"."</td>".
               "<td>". "&nbsp;<a href=update.php?id=".$row['id'].">Update</a><br>"."</td></tr>";
 }
 mysqli_free_result($result);
 mysqli_close($link);
?>
</div>
<div class="img" style="position:fixed;top:0px;margin-left: 0px;">
<img src="l.jpg" height="145" width="100">
</div>
<div class="img" style="position:fixed;top:0px;right:0px;">
<img src="l.jpg" height="145" width="100">
</div>
</tbody></table>
</body>
</html>
