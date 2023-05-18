<?php
// připojení k databázi
$host = "md361.wedos.net";
$user = "w316753_login";
$password = "a3fkVTRU";
$dbname = "d316753_login";
$connection = mysqli_connect($host, $user, $password, $dbname);

// kontrola, zda byl odeslán formulář
if(isset($_POST['submit'])) {
  // kontrola, zda jsou vyplněna všechna pole
  if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
    echo "Vyplňte prosím všechna pole.";
  } else {
    // kontrola, zda heslo a potvrzení hesla se shodují
    if($_POST['password'] != $_POST['confirm_password']) {
      echo "Heslo a potvrzení hesla se neshodují.";
    } else {
      // kontrola, zda uživatelské jméno již neexistuje v databázi
      $username = $_POST['username'];
      $query = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($connection, $query);
      if(mysqli_num_rows($result) > 0) {
        echo "Uživatelské jméno již existuje.";
      } else {
        // vložení nového uživatele do databáze
        $password = $_POST['password'];
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($connection, $query);
        header("Location: loginpage.html");
      }
    }
  }
}
?>