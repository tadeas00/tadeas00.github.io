<?php
  // Připojení k databázi
  $servername = "md361.wedos.net";
  $username = "w316753_login";
  $password = "a3fkVTRU";
  $dbname = "d316753_login";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Připojení k databázi selhalo: " . $conn->connect_error);
  }

  // Ověření přihlašovacích údajů
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Přihlášení úspěšné
      session_start();
      $_SESSION["username"] = $username;
      header("Location: login.html");
    } else {
      // Přihlášení selhalo
      echo "Neplatné uživatelské jméno nebo heslo.";
    }
  }

  $conn->close();
?>