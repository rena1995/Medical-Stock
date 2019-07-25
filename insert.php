<!doctyppe html>
<html>
<head>
<link rel="icon" type="image/x-icon" href="farmakeio1.jpg"/>
<title>Καταχώρηση Προϊόντος</title>
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
div.form1 table  {
 position:relative;
 background-color: #b3ffb3; 
 margin-right:auto;
 margin-left:auto; 
 padding:8px 2px 12px 9px;
 width:29%;
 }
table, th, td { height:43px;}
div.insert h4 {
text-align:center;
position: relative;
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
<div class="form1">
<h2><center>Καταχώρηση Φαρμάκου:<center></h2>
<form method=POST action=# style=" margin-top: 20px;">
<table>
<tr>
<td>BARCODE*:</center></td><td><input type="text" name=mbar value="" placeholder="0000000000000"  pattern="[0-9]{13}" required></td>
</tr>
<tr>
<td>Ονομασία*:</td><td><input type="text" name="mname" value="" pattern="\D{1,50}" required ></td>
</tr>
<td>mg*:</td><td><input type="number" name=mmg value="" placeholder="0" min="0"  step="1" required></td>
</tr>
<td>Δραστική Ουσία*:</td><td><input type="text" name=mdra value=""  pattern="\D{1,50}"  required></td>
</tr>
<td>Ημερομηνία Παραλαβής*:</td><td><input type="date" name=mdate value=""  required></td>
</tr>
<td>Τιμή*:</td><td><input type="number" name=mval value="" placeholder="0.00€" step="0.01" min="0.00" required></td>
</tr>
<td>ΦΠΑ*:</td><td><input type="number" name=mfpa value="" placeholder="0.00%" step="0.01" min="0.00" max="100,00" required></td>
</tr>
</tr>
<td>Διαθέσιμα*:</td><td><input type="number" name=mav value="" placeholder="0" min="0" required></td>
</tr>
<tr><td colspan=2><center><input type="submit" value=Καταχώρηση> <input type="reset" value="Eπαναφορά"></center></td></tr>
</table>
</form>
</div>
<div>
<div class="insert" style="width:40%;position:relative;margin-left:auto;margin-right:auto;margin-top:0px;">
<?php
include('auth.inc');
if (isset($_POST) && !empty($_POST)) {
        $link=@mysqli_connect(HOSTER,USER,PASO,DB);
        if (!$link) {
               echo "<br><h4>Error connecting to Db!!</h4><br>";
                exit(0);
        }
        $query="select*from meds;";
        if (!@mysqli_query($link,$query)) {
        echo "<h2><center><h4> Ο πίνακας δεν έχει εγκατασταθεί!</h4></center></h2> <br>";
        exit();
        }
        //Η ΜΟΡΦΗ ΤΩΝ ΠΕΔΙΩΝ ΚΑΘΟΡΙΖΕΤΑΙ ΑΠΟ ΤΗΝ ΦΟΡΜΑ ΟΠΟΤΕ ΔΕΝ ΧΡΕΙΑΖΕΤΑΙ ΕΛΕΓΧΟΣ ΤΙΜΩΝ
       $query="insert into meds values('',".$_POST['mbar'].",'".$_POST['mname']."',".$_POST['mmg'].",'".$_POST['mdra']."','".$_POST['mdate']."',".$_POST['mval'].",".$_POST['mfpa'].",".$_POST['mav'].")";
        $res=mysqli_query($link,$query);
        if (!$res) {
                echo "<br><h4>Λάθος στην καταχώρηση</h4><br>";
        } else {
         echo  "<br><h4>Η καταχώρηση έγινε επιτυχώς</h4><br>";     
               }
        mysqli_close($link);
}
?>
</div>
</body>
</html>
