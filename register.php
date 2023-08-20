<?php
// připojení k databázi
$host = "md361.wedos.net";
$user = "w316753_login";
$password = "a3fkVTRU";
$dbname = "d316753_login";
$connection = mysqli_connect($host, $user, $password, $dbname);

// Kontrola, zda byl odeslán formulář
if(isset($_POST['submit'])) {
  // Kontrola, zda jsou vyplněna všechna pole
  if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
    echo "Vyplňte prosím všechna pole.";
  } else {
    // Kontrola, zda heslo a potvrzení hesla se shodují
    if($_POST['password'] != $_POST['confirm_password']) {
      echo "Heslo a potvrzení hesla se neshodují.";
    } else {
      // Kontrola, zda uživatelské jméno nebo e-mail již existuje v databázi
      $username = $_POST['username'];
      $email = $_POST['email'];
      $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
      $result = mysqli_query($connection, $query);
      if(mysqli_num_rows($result) > 0) {
        echo "Uživatelské jméno nebo e-mail již existuje.";
      } else {
        // Vložení nového uživatele do databáze
        $password = $_POST['password'];
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        mysqli_query($connection, $query);
        header("Location: loginpage.html");

        // Odeslání e-mailu s přihlašovacími údaji
        $to = $_POST['email'];
        $subject = "Přihlašovací údaje";
        $message = "Vaše přihlašovací údaje:\nUživatelské jméno: $username\nHeslo: $password\nV případě nesrovnalostí se nebojte napsat na tento email (info@bilapodkova.eu) nebo správce webu (admin@bilapodkova.eu nebo tadeasjanprek6@gmail.com)\n\nHezký zbytek dne z Bílé podkovy!";
        $headers = "From: info@bilapodkova.eu";

        if(mail($to, $subject, $message, $headers)) {
          echo "Registrace proběhla úspěšně. Byl vám zaslán e-mail s přihlašovacími údaji.";
        } else {
        echo "Nepodařilo se odeslat e-mail s přihlašovacími údaji.";
        }
      }
    }
  }
}
?>