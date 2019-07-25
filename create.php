<!doctyppe html>
<html>
<head>
<link rel="icon" type="image/x-icon" href="farmakeio1.jpg"/>
<title>Εγκατάσταση Πίνακα</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://kalipso.math.uoi.gr/bootstrap4/bootstrap.min.css">
  <script src="https://kalipso.math.uoi.gr/bootstrap4/jquery.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/popper.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/tether.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/bootstrap.min.js"></script>
<style>
body {
background-image: url("xapia.jpg") ;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: 50% 80%;
background-position:right;
}
div.create h2 {
border: 1px solid black ;
background-color: #b3ffb3;
padding:8px 2px 12px 9px;
}
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
<div class="create" style="position: relative;margin-right: 10px; margin-top: 50px;padding:8px 2px 12px 9px;width:50%;">
<?php
include('auth.inc');
$link=@mysqli_connect(HOSTER,USER,PASO,DB);
if (mysqli_connect_errno($link)) {
        echo "<h2>Failed to connect -".mysqli_connect_error($link)."<br></h2>";
        exit();
}
$query="select*from meds;";
if (@mysqli_query($link,$query)) {
        echo "<h2><center> O πίνακας υπάρχει ήδη!</center></h2> <br>";

}else{
        $query="create table meds(id int auto_increment,".
        "barcode bigint unique ,name varchar(80) ,mg int,active_substance varchar(80),".
        "delivery_date date,value float(5,2),fpa float(5,2),available int ,primary key(id))";
if (@mysqli_query($link,$query)) {
        echo "<h2><center> O πίνακας δημιουργήθηκε επιτυχώς!</center></h2> <br>";
 } else {
        echo "<h2><center>Ο πίνακας δεν δημιουργήθηκε:</center></h2>" .mysqli_error($link)."<br>";
}
}
 mysqli_close($link);
?>
</div>
<div class="img" style="position:relative;top:50px;margin-left: 150px;">
<img src="t.jpg" height="300" width="500">
</div>
</body>
</html>
