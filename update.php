<!doctyppe html>
<html>
<head>
<title>Τροποποίηση Καταχώρησης</title>
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
<div class="update" style="background-color:#b3ffb3;">
<?php
include('auth.inc');
//Method POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
        $link=@mysqli_connect(HOSTER,USER,PASO,DB);
        if (!$link) {
                echo "<center><h2>Error connecting to Db!!</h2></center>";
                exit(0);
        }
         $query="update meds set barcode=".$_POST['mbar'].",name='".$_POST['mname']."',mg=".$_POST['mmg'].",active_substance='".$_POST['mdra']."',delivery_date='". $_POST['mdate']."',value=". $_POST['mval'].",fpa=". $_POST['mfpa'].",available=". $_POST['mav']." where id=".$_POST['id'];
        $res=mysqli_query($link,$query);
        if (!$res) {
                echo "<center><h2>Η τροποποίηση δεν έγινε!</h2></center>";
                exit();
        }else{
        echo "<center><h2>Η τροποποίηση έγινε επιτυχώς!</h2></center>";}
        mysqli_query($link,$query);
        mysqli_close($link);
}
//Method GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
        $link=@mysqli_connect(HOSTER,USER,PASO,DB);
        if (!$link) {
                echo "Error connecting to Db!!";
                exit(0);
        }
        $query="select * from meds where id=".$_GET['id'];
        $res=mysqli_query($link,$query);
        if (!$res) {
                echo "Λάθος στην Query";
                exit();
        }
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
        mysqli_close($link);
?>
</div>
<!doctyppe html>
<html>
<head>
<style>
div.form1 table {
 position:relative;
 background-color: #b3ffb3;
 margin-right:auto;
 margin-left:auto;
 padding:8px 9px 12px 9px;
 width:29%;
}
table, th, td { height:43px;}
</style>
</head>
<body>
<div class="form1">
<h2><center>Τροποποίηση Καταχώρησης:<center></h2>
<form method=POST action="#" style=" margin-top: 20px;">
<table>
<tr>
<td>
Id:</td><td><input type=text readonly name=id value=<?=$row['id']?>></td>
</td>
</tr>
<tr>
<td>BARCODE*:</td><td><input type=text name=mbar placeholder="0000000000000" pattern="[0-9]{13}" required value=<?=$row['barcode']?>></td>
</tr>
<tr>
<td>Ονομασία*:</td><td><input type=text name=mname pattern="\D{1,50}" required value=<?=$row['name']?>></td>
</tr>
<tr>
<td>mg*:</td><td><input type=number name=mmg placeholder="0" min="0" step="1" required value=<?=$row['mg']?>></td>
</tr>
<tr>
<td>Δραστική Ουσία*:</td><td><input type=text name=mdra  pattern="\D{1,50}"  required value=<?=$row['active_substance']?>></td>
</tr>
<tr>
<td>Ημερομηνία Παραλαβής*:</td><td><input type=date name=mdate required value=<?=$row['delivery_date']?>></td>
</tr>
<tr>
<td>Τιμή*:</td><td><input type=number name=mval placeholder="0.00€" step="0.01" min="0.00" required value=<?=$row['value']?>></td>
</tr>
<tr>
<td>ΦΠΑ*:</td><td><input type=number name=mfpa placeholder="0.00%" step="0.01" min="0.00" max="100,00" required value=<?=$row['fpa']?>></td>
</tr>
<tr>
<td>Διαθέσιμα*:</td><td><input type=number name=mav placeholder="0" min="0" required value=<?=$row['available']?>></td>
</tr>
<tr><td colspan=2><input type=submit value=Καταχώρηση></td></tr>
</table>
</form>
</div>
</body> 
</html>
<?php
}
?>

