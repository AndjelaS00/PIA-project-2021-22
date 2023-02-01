<?php
include 'konekcija.php';
session_start();
if(isset($_POST["komentarisi"])){ 
    $id=$_POST["komentarisi"];
    $komentar=$_POST["Komentar"];
    $conn = konekcija();
    $sql="UPDATE `aktivnosti` SET `komentar`='$komentar' WHERE `aktivnosti`.`idAktivnosti`='$id'";
    $conn->query($sql);
   
    zatvaranjeKonekcije($conn);
}
if(isset($_POST["promeniStatus"])){ 
    $id=$_POST["promeniStatus"];
    $status=$_POST["Status"];
    $conn = konekcija();
    $sql="UPDATE `aktivnosti` SET `statusAktivnosti`='$status' WHERE `aktivnosti`.`idAktivnosti`='$id'";
    $conn->query($sql);
   
    zatvaranjeKonekcije($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pregled mojih aktivnosti</title>
        <link rel="stylesheet" href="style.css"/>
        </head>
    <body>
    <div class="search-container">
                    <form class="searchbox" action="/zaposleni.php">
                      <input type="search" placeholder="Pretraga po nazivu" name = "pretraga">
                      <button id = "dugme" type="submit" value="search">&nbsp;</button>
                    </form>
                  </div>
      <br>
      <br>
     <br>
     <table id="tabela">
    <?php
         $conn = konekcija();
         $idZaposlenog=$_SESSION['korisnik'];
         if(isset($_GET["pretraga"])){
            $pretraga=$_GET["pretraga"];
            $sql="SELECT * FROM projekat JOIN aktivnosti ON projekat.idProjekta =aktivnosti.idProjekta JOIN delegirano ON aktivnosti.idAktivnosti = delegirano.idAktivnosti WHERE delegirano.idKorisnika ='6' AND projekat.nazivProjekta = '$pretraga'"; 
          }
          else{
           $sql="SELECT * FROM projekat JOIN aktivnosti ON projekat.idProjekta =aktivnosti.idProjekta JOIN delegirano ON aktivnosti.idAktivnosti = delegirano.idAktivnosti WHERE delegirano.idKorisnika ='6'"; 
          }
          $rezultat=$conn->query($sql);
          $niz = array();
          if($rezultat->num_rows > 0){
          while($red = $rezultat->fetch_assoc()){
           if (!in_array($red["nazivProjekta"], $niz)) {
           echo '
           <div class="board-list">
             <div class="list-title">'. $red["nazivProjekta"]. '</div>';
             array_push($niz, $red["nazivProjekta"]);
             $id = $red["idProjekta"];
             $sql="SELECT * FROM `aktivnosti` JOIN delegirano ON aktivnosti.idAktivnosti = delegirano.idAktivnosti WHERE aktivnosti.idProjekta = '$id' AND delegirano.idKorisnika =  '6'"; 
 
             $rezultat2=$conn->query($sql);
             if($rezultat2->num_rows > 0){
            echo '
                     <thead>
                         <tr>
                             <th >Id aktivnosti  </th>
                             <th >Id projekta </th>
                             <th >Naziv aktivnosti  </th>
                             <th >Naziv projekta  </th>
                             <th >Status aktivnosti  </th>
                             <th >   </th>
                             <th >Opis aktivnosti  </th>
                             <th >Komentar  </th>
                             <th >Odgovor komentara  </th>
                         </tr>
                     </thead>';
                     while($red2 = $rezultat2->fetch_assoc()){
                        echo "<tr>";
                        echo '<td>'. $red["idAktivnosti"].'</td>';
                        echo '<td>'. $red["idProjekta"]. '</td>';
                        echo '<td>'. $red["nazivAktivnosti"]. '</td>';
                        echo '<td>'. $red["nazivProjekta"]. '</td>';
                        echo '<td>'. $red["statusAktivnosti"].'</td>'; 
                        echo '<td><form  method="post" action="/zaposleni.php">
                        <input type="radio" name="Status" value="U fazi čekanja" checked> U fazi čekanja
                        <input type="radio" name="Status" value="U fazi izrade"> U fazi izrade
                        <input type="radio" name="Status" value="Završen"> Završen
                        <button name="promeniStatus"  value="'. $red["idAktivnosti"]. '">Promeni status aktivnosti</button></form></td>';
                        echo '<td>'. $red["opisAktivnosti"].'</td>';
                        echo '<td><form method="post" action="/zaposleni.php" >
					    <input type="text" id="Komentar" name="Komentar" placeholder="Dodaj komentar...">
                        <button name="komentarisi" value="'.$red["idAktivnosti"]. '">Potvrdi komentar</button></td></form>';
                        echo '<td>'. $red["odgovorKomentara"].'</td>';
                        
                       
                       
                        echo '</tr>';
                        
                    }
                     
                }
            }
        }
    }
                zatvaranjeKonekcije($conn);
        
            
            ?>
   
        
        </table>
    </div>
  </body>
</html>
        
    
        