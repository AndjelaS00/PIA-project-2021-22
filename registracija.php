<?php
include 'konekcija.php';
if(isset($_POST["registrovanje"])){
    $ime = $_POST['Ime'];
    $prezime = $_POST['Prezime'];
    $uloga= $_POST['Uloga'];
    $korisnik = $_POST['Username'];
    $sifra= $_POST['Sifra'];
    $conn = konekcija();
    $sql = "INSERT INTO `korisnik` ( `ime`, `prezime`, `uloga`, `korisnickoIme`, `sifra`, `potvrda`) VALUES ('$ime', '$prezime', '$uloga', '$korisnik', '$sifra', 0);";
    if($conn->query($sql)){
        header( 'location: /login.php' );
    }
    else{
        echo '<script>alert("Nije uneto, korisničko ime zauzeto.")</script>';
    }



    zatvaranjeKonekcije($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Registracija</title>

        <link rel="stylesheet" href="login.css">

    </head>
    <body>

<div class="page">
<form class="login" method="post" action="/registracija.php">
      <input type="text" id="Username" name="Username" placeholder="Korisničko ime">
      <br>
      <br>
      <input type="text" id="Ime" name="Ime" placeholder="Ime">
      <br>
      <br>
      <input type="text" id="Prezime" name="Prezime" placeholder="Prezime">
      <br>
      <br>
      <input type="password" id="Sifra" name="Sifra" placeholder="Šifra">
      <br>
      <br>
      <input type="radio" name="Uloga" value="administrator" checked> Administrator
      <br>
      <br>
      <input type="radio" name="Uloga" value="menadzer" > Menadžer
      <br>
      <br>
      <input type="radio" name="Uloga" value="zaposleni" > Zaposleni
      <br>
      <br>


      
      <button name="registrovanje">Registruj me</button>
      <a href="login.php"> Imate nalog? </a></p>
      </form>
         </div>
    </body>
</html>