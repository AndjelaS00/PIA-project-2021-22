
<html>
 <head>
 <title>Probna stranica za nastavu</title>
 <script type="text/javascript">
 // Funkcija od korsinka trazi potvrdu brisanja
 function brisi(id_knjiga) {
 var odgovor=confirm("Brisanje knjige: Da li ste sigurni?");
 if (odgovor)
 window.location = "brisi.php?id="+id_knjiga;
 }
 // Funkcija reaguje na pritisak na dugme "izmeni" i
 // usmerava browser na php skript za izmenu podataka o knjizi
 function izmeni(id_knjiga) {
 window.location = "izmeni.php?id="+id_knjiga;
 }
 </script>
 </head>
 <body>
 <h1>PMF biblioteka</h1>
 <!-- Forma za pretragu -->
 <form action="<?php $_SERVER["PHP_SELF"] ?>" method="get">
 <input id="pretraga" name="pretraga" type="text" size="20" />
 <input type="submit" value="Trazi" />
 </form>
 <!-- Kraj forme za pretragu -->
 <?php
 require_once 'Knjiga_db.php';
 $knjige = new Knjiga_db();
 // Ako je setovano $_GET['pretraga'], postavi kriterijum za filtriranje.
 // Ako je vrednost "pretraga", filtiranje se ne vrsi
 if (!isset ($_GET['pretraga']) || $_GET['pretraga']=='pretraga') {
 $knjige->stampaj();
 }
 else {
 $kriterijum_za_naslov = $_GET['pretraga'];
 $knjige->stampaj($kriterijum_za_naslov);
 }
 
 ?>
 <!-- Kratka forma koja vodi na stranicu dodaj.php -->
 <form action="dodaj.php" method="get">
 <input type="submit" value="Dodaj">
</form>
</body>
</html>