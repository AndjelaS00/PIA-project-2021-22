<?php
session_start();
if ($_SESSION["potvrdjenpristup"] != true || $_SESSION['rola']!='Administrator'){
  header( 'location: /index.php' );
 }
include 'konekcija.php';
if (isset($_POST['brisi'])) {
    $id= $_POST['brisi'];
    $conn = konekcija();

    $sql="DELETE FROM `korisnik` WHERE `idKorisnika` = '$id'";
   
    $conn->query($sql);
   
    zatvoranjeKonekcije($conn);
}
if(isset($_POST["unoskorisnika"])){
  
    $ime= $_POST['Ime'];
    $prezime= $_POST['Prezime'];
    $uloga = $_POST['Uloga'];
    $korisnik= $_POST['Username'];
    $sifra= $_POST['Sifra'];
    $conn = konekcija();
    $sql = "INSERT INTO `korisnik` ( `ime`, `prezime`, `uloga`, `korisnickoIme`, `sifra`, `potvrda`) VALUES ('$ime', '$prezime', '$uloga', '$korisnik', '$sifra', 1);";
    if($conn->query($sql)){
        echo '<script>alert("Korisnik je unet.")</script>';
    }
    else{
        echo '<script>alert("Uneto korisničko ime je zauzeto.")</script>';
    }
    zatvoranjeKonekcije($conn);
    }
    if (isset($_POST['azuriraj'])) {
        $id= $_POST['azuriraj'];
        $noviId= $_POST['Id'];
        $ime= $_POST['Ime'];
        $prezime= $_POST['Prezime'];
        $uloga= $_POST['Uloga'];
        $korisnik= $_POST['Username'];
        $sifra= $_POST['Sifra'];
        $conn = konekcija();
        $sql="UPDATE `korisnik` SET `idKorisnika` = '$noviId', `ime` = '$ime', `prezime` = '$prezime', `uloga` = '$uloga', `korisnickoIme` = '$korisnik', `sifra` = '$sifra' WHERE `idOsobe` = '$id'";
        
  $conn->query($sql);
  zatvoranjeKonekcije($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Kontrolna tabla</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login.css">
    </head>
    <body style="background-image: url(bg2.jpg); background-repeat:repeat-y;"> 
 <header>
 <!--   <?php if($_SESSION["potvrdjenpristup"] == true && $_SESSION['uloga'] =='Administrator'){
                <form method=post action="/login.php?t=logout" style="margin-left: 1300px;">
                  <button class="button3" value="logout">Izloguj se</button>  
              </form>
    }
              </header>
              ?>
              -->
              <table id="tabela">
<?php
     $conn = konekcija();
     $sql="SELECT * FROM korisnik WHERE `potvrda` = '0'";
     $rezultat=$conn->query($sql);
     if($rezultat->num_rows > 0){
        echo '
                 <h1>Potvrda korisnika</h1>
                 <thead>
                     <tr>
                         <th >Id</th>
                         <th >Ime</th>
                         <th >Prezime</th>
                         <th >Uloga</th>
                         <th >Korisničko ime</th>
                         <th >Šifra</th>
                     </tr>
                 </thead>';
                 while($red = $rezultat->fetch_assoc()){
                    echo "<tr>";
                    echo '<td>'. $red["idKorisnika"].'</td>';
                    echo '<td>'. $red["ime"]. '</td>';
                    echo '<td>'. $red["prezime"]. '</td>';
                    echo '<td>'. $red["uloga"]. '</td>';
                    echo '<td>'. $red["korisnickoIme"]. '</td>';
                    echo '<td>'. $red["sifra"]. '</td>';
                    echo '<form method="post" action="/kontrola.php" ><td><button class="dugme" name="Potvrdi" value="'. $red["idKorisnika"]. '">Potvrdi</button></td>';
                 }
                }
                zatvaranjeKonekcije($conn);
                ?>
                </tr>
            </table>
            <h1>Unos korisnika</h1>
            <div class="page">
            <form class="login" method="post" action="/kontrola.php">
            <input type="text" id="Username" name="Username" placeholder="Korisničko ime">
              <input type="text" id="Ime" name="Ime" placeholder="Ime">
              <input type="text" id="Prezime" name="Prezime" placeholder="Prezime">
              <input type="password" id="Sifra" name="Sifra" placeholder="Šifra">
              <input type="radio" name="Uloga" value="administrator" checked> Administrator
              <input type="radio" name="Uloga" value="menadzer"> Menadžer
              <input type="radio" name="Uloga" value="zaposleni"> Zaposleni
              
              <button name="unoskorisnika">Potvrdi</button>

    </form>
</div> 

    <table id="tabela">
  <?php 
      $conn = konekcija();
      $sql="SELECT * FROM korisnik WHERE `potvrda` = '1'";

      $rezultat=$conn->query($sql);
      if($rezultat->num_rows > 0){
        echo '
        <h1>Brisanje</h1>
             <thead>
                 <tr>
                  <th >Id</th>
                  <th >Ime</th>
                  <th >Prezime</th>
                  <th >Uloga</th>
                  <th >Korisničko ime</th>
                  <th >Šifra</th>
                 </tr>
             </thead>';
             while($row = $rezultat->fetch_assoc()){
                echo "<tr>";
                echo '<td>'. $row["idKorisnika"].'</td>';
                echo '<td>'. $row["ime"]. '</td>';
                echo '<td>'. $row["prezime"]. '</td>';
                echo '<td>'. $row["uloga"]. '</td>';
                echo '<td>'. $row["korisnickoIme"]. '</td>';
                echo '<td>'. $row["sifra"]. '</td>';
                echo '<form method="post" action="/kontrola.php" ><td><button class="dugme" name="brisi"  value="'. $red["idKorisnika"]. '">Obriši</button></td></form></tr>';
            }
        }
        zatvaranjeKonekcije($conn);
        ?>
        </table>
    
      <table id="tabela">
      <?php 
    
      $conn = konekcija();
      $sql="SELECT * FROM korisnik WHERE `potvrda` = '1'";
      $uloge=["Administrator", "Menadžer", "Zaposleni"];
      $rezultat=$conn->query($sql);

      if($rezultat->num_rows > 0){
        echo '
                 <h1>Ažuriranje korisnika</h1>
                 <thead>
                     <tr>
                     <th >Id</th>
                     <th >Ime</th>
                     <th >Prezime</th>
                     <th >Uloga</th>
                     <th >Korisničko ime</th>
                     <th >Šifra</th>
                     </tr>
                 </thead>';

                 while($red = $rezultat->fetch_assoc()){
                    echo '<form method="post" action="/kontrola.php" ><tr>';
                    echo '<td><input class="inputtabela" type="text" id="Id" name="Id" value="'. $red["idKorisnika"].'"></td>';
                    echo '<td><input class="inputtabela" type="text" id="Ime" name="Ime" value="'. $red["ime"].'"></td>';
                    echo '<td><input class="inputtabela" type="text" id="Prezime" name="Prezime" value="'. $red["prezime"].'"></td>';
                    echo '<td><input class="inputtabela" type="radio" name="Uloga" value="administrator" checked> Administrator
                    <input type="radio" name="Uloga" value="menadzer" checked> Menadžer
                    <input type="radio" name="Uloga" value="zaposleni" checked> Zaposleni';
                    echo '<td><input class="inputtabela" type="text" id="Username" name="Username" value="'. $red["korisnickoIme"].'"></td>';
                    echo '<td><input class="inputtabela" type="text" id="Sifra" name="Sifra" value="'. $red["sifra"].'"></td>';

                }
               
                echo '<td><button class="dugme" name="azuriraj"  value="'. $red["idKorisnika"]. '">Ažuriraj</button></td></form></tr>';
              }
              }
            zatvaranjeKonekcije($conn);
            ?>
            </table>
            
                </body>
            </html>