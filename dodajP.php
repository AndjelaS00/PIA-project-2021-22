<?php
session_start();
include 'konekcija.php';
if(isset($_POST["dodaj"])){
  
    $nazivProjekta = $_POST['nazivProjekta'];
    $lokacija= $_POST['Lokacija'];
    $sprema= $_POST['Sprema'];
    $opis= $_POST['Opis'];
    $pogodnosti= $_POST['Pogodnosti'];
    $rok= $_POST['RokKonkursa'];
$conn = konekcija();
$sql = "INSERT INTO `projekat` ( `nazivProjekta`, `lokacija`, `sprema`, `opis`, `pogodnosti`, `rok`, `status`) VALUES ( '$nazivProjekta', '$lokacija', '$sprema', '$opis', '$pogodnosti', '$rok', 'U fazi izrade');";
$conn->query($sql);
zatvaranjeKonekcije($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Dodavanje projekta</title>

        <link rel="stylesheet" href="login.css">

    </head>

    <body>
    <h1>Dodavanje projekta</h1>

        <div class="page">
              <form class="login" method="post" action="/dodajP.php">

              <input type="text" id="nazivProjekta" name="nazivProjekta" placeholder="Naziv">
              <br>
              <br>
              <input type="text" id="Lokacija" name="Lokacija" placeholder="Lokacija">
              <br>
              <br>
              <input type="radio" name="Sprema" value="osnovna" checked> Osnovna 
              <input type="radio" name="Sprema" value="srednja"> Srednja
              <input type="radio" name="Sprema" value="visa"> Viša
              <input type="radio" name="Sprema" value="fakultet">Fakultet
              <br>
              <br>
              <input type="text" id="Opis" name="Opis" placeholder="Opis">
              <br>
              <br>
              <input type="text" id="Pogodnosti" name="Pogodnosti" placeholder="Pogodnosti">
              <br>
              <br>
              <input type="text" id="RokKonkursa" name="RokKonkursa" placeholder="Rok">
              <br>
              <br>
                
              <button name="dodaj">Dodaj</button>


            </form>
        </div>

    </body>
</html>