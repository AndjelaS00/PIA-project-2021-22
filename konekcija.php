<?php
    function konekcija()
     {
     $ime_hosta= "localhost";
     $korisnik = "root";
     $sifra = "";
     $ime_baze = "andjela";
     $conn = mysqli_connect($ime_hosta, $korisnik, $sifra,$ime_baze);

     return $conn;
     }
     function zatvaranjeKonekcije($conn)
     {
     $conn -> close();
     }
 ?>