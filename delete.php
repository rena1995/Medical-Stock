<!doctyppe html>
<html>
<head>
<title>Διαγραφή Καταχώρησης</title>
<link rel="icon" type="image/x-icon" href="farmakeio1.jpg"/>
<title></title>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="http://kalipso.math.uoi.gr/bootstrap4/bootstrap.min.css">
  <script src="https://kalipso.math.uoi.gr/bootstrap4/jquery.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/popper.min.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/tether.js"></script>
  <script src="http://kalipso.math.uoi.gr/bootstrap4/js/bootstrap.min.js"></script>
<style>
body {
background-image: url("iatrikes-exetaseis.jpg ") ;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: 100% 100%;
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
</body>
</html>
<div class="delete" style="background-color:#b3ffb3;">
<?php
include('auth.inc');
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$link=@mysqli_connect(HOSTER,USER,PASO,DB);
	if (mysqli_connect_errno($link)) {
		echo "<center><h2>Failed to connect -".mysqli_connect_error($link)."</h2></center><br><br>";
		exit();
	}
$query="delete from meds where id=".$_GET['id'];
$result=mysqli_query($link,$query);
if (!$result) {
	echo "<center><h2>Η διαγραφή δεν έγινε!</h2></center><br>";
}
else {
	echo "<center><h2>Η διαγραφή έγινε επιτυχώς!</h2></center><br>";
}
 mysqli_close($link);
}
?>
</div>
