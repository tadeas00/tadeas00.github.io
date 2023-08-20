<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    // Uživatel není přihlášen, přesměrování na přihlašovací stránku
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Členská sekce</title>
</head>
<body>
  <h1>Vítejte v členské sekci, <?php echo $_SESSION["username"]; ?>!</h1>
  <p>Zde můžete zobrazovat a upravovat své informace.</p>
  <a href="logout.php">Odhlásit se</a>
</body>
</html>