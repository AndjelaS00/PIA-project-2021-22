<?php
session_start();
include 'konekcija.php';
if (isset($_POST['izmeni'])) {
    $id= $_POST['izmeni'];
    $idnovi = $_POST['Id'];
    $nazivProjekta = $_POST['nazivProjekta'];
    $lokacija = $_POST['Lokacija'];
    $sprema = $_POST['Sprema'];
    $opis = $_POST['Opis'];
    $pogodnosti= $_POST['Pogodnosti'];
    $rok = $_POST['Rok'];
    $status = $_POST['Status'];
    $conn = konekcija();
    $sql="UPDATE `projekat` SET `idProjekta` = '$idnovi', `nazivProjekta` = '$nazivProjekta', `lokacija` = '$lokacija', `sprema` = '$sprema', `opis` = '$opis', `pogodnosti` = '$pogodnosti', `rok` = '$rok', `status` = '$status' WHERE `projekat`.`idProjekta` = '$id'";
    $conn->query($sql);
   
    zatvaranjeKonekcije($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>

<title>Izmena projekta</title>

<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="style.css">

</head>

<body>
        <div class="page">
        <table id="tabela" align="center">
<?php

         $conn = konekcija();
         $sql="SELECT * FROM projekat" ;
         $rezultat=$conn->query($sql);
         if($rezultat->num_rows > 0){
         echo '
         <h1>Izmena projekata</h1>
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Naziv projekta</th>
                 <th>Lokacija</th>
                 <th>Uloga</th>
                 <th>Školska sprema</th>
                 <th>Opis</th>
                 <th>Pogodnosti</th>
                 <th>Rok</th>
                 <th>Status</th>
             </tr>
         </thead>';
            while($red = $rezultat->fetch_assoc()){
                echo '<form method="post" action="/izmeni.php"><tr>';
                echo '<td><input type="text" id="Id" name="Id" value="'.$red["idProjekta"].'"></td>';
                echo '<td><input type="text" id="nazivProjekta" name="nazivProjekta" value="'.$red["nazivProjekta"].'"></td>';
                echo '<td><input type="text" id="Lokacija" name="Lokacija" value="'.$red["lokacija"].'"></td>';
                echo  '<td><input type="radio" name="Sprema" value="osnovna" checked> Osnovna';
                echo  '<input type="radio" name="Sprema" value="srednja"> Srednja';
                echo  '<input type="radio" name="Sprema" value="visa"> Viša';
                echo  '<input type="radio" name="Sprema" value="fakultet">Fakultet</td>';
                echo '<td><input type="text" id="Opis" name="Opis" value="'.$red["opis"].'"></td>';
                echo '<td><input type="text" id="Pogodnosti" name="Pogodnosti" value="'.$red["pogodnosti"].'"></td>';
                echo '<td><input type="text" id="Rok" name="Rok" value="'.$red["rok"].'"></td>';
                echo  '<td><input type="radio" name="Status" value="cekanje" checked> U fazi cekanja';
                echo  '<input type="radio" name="Status" value="izrada"> U fazi izrade' ;
                echo  '<input type="radio" name="Status" value="zavrsen">Završen</td>';
                echo '<td><button class="dugme" name="izmeni" value="'. $red["idProjekta"]. '">Izmeni projekat</button></td></tr></form>';
            }
            }
            zatvaranjeKonekcije($conn);
            ?>
            </table>
               
           </div> 
   
       </body>
   </html>