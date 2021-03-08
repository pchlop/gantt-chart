<?php
  session_start();
  if(isset($_SESSION['login']))
  header('Location: welcome.php');
?>

<!DOCTYPE html>
<html lang="pl">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wykresy Gantta</title>
    <?php 
      if(!(isset($_COOKIE["css"]))) { $css = "style2"; } 
      else { $css = $_COOKIE["css"];}
      ?>
    <link rel="stylesheet" href="css/<?php echo $css; ?>.css">
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  </head>
  
  <body>
    <?php
      include "nav.php";
    ?>
    <header>
      <div class="greeting">
        <h1>Witaj w aplikacji Wykresy Gantta</h1>
        <p>Zarządzaj projektem szybciej, lepiej i gdzie tylko chcesz</p>
      </div>
    </header>
    <main>
      <div class="buttons">
        <a href="#" id="login" class="button login">Zaloguj się</a>
        <a href="#" id="signup" class="button register">Zarejestruj się</a>
      </div>
    </main>
    <div style="color: red">
    <?php
    
       if(isset($_SESSION['login_error']))
       echo $_SESSION['login_error'];
       unset($_SESSION['login_error']);
     
       if(isset($_SESSION['re_username']))
       echo $_SESSION['re_username'];
       unset($_SESSION['re_username']);
     
       if(isset($_SESSION['re_email']))
       echo $_SESSION['re_email'];
       unset($_SESSION['re_email']);
     
       if(isset($_SESSION['re_password']))
       echo $_SESSION['re_password'];
       unset($_SESSION['re_password']);
     
       if(isset($_SESSION['re_first_name']))
       echo $_SESSION['re_first_name'];
       unset($_SESSION['re_first_name']);
     
       if(isset($_SESSION['re_last_name']))
       echo $_SESSION['re_last_name'];
       unset($_SESSION['re_last_name']);
     
       if(isset($_SESSION['registered']))
       echo $_SESSION['registered'];
       unset($_SESSION['registered']);
     
       if(isset($_SESSION['re_nick']))
       echo $_SESSION['re_nick'];
       unset($_SESSION['re_nick']);
    ?>
  </div>
    <div id="login_modal" class="container hidden">
      <div class="text">Zaloguj się</div>
      <form action="db/login.php" method="post" id="loginform">
        <div class="input-data">
          <label for="loginusername">Nazwa użytkownika</label>
          <input type="text" name="loginusername" id="loginusername" />
        </div>

        <div class="input-data">
          <label for="loginpassword">Hasło</label>
          <input type="password" name="loginpassword" id="loginpassword"/>
        </div>
        <div class="buttons-container">
          <input class="modal-buttons" type="submit" value="Zaloguj się" />
          <button type="button" class="modal-buttons" id="modal_close">Zamknij</button>
        </div>
      </form>
    </div>

    <div id="signup_modal" class="container hidden">
      <div class="text">Utwórz konto</div>
      <form action="db/register.php" method="post" id="registerform">
        <div class="input-data">
          <label for="signusername">Nazwa użytkownika</label>
          <input type="text" name="signusername"  id="signusername"/>
        </div>

        <div class="input-data">
          <label for="firstname">Imię</label>
          <input type="text" name="firstname" id="firstname"/>
        </div>

        <div class="input-data">
          <label for="lastname">Nazwisko</label>
          <input type="text" name="lastname" id="lastname"/>
        </div>

        <div class="input-data">
          <label for="email">e-mail</label>
          <input type="text" name="email" id="email"/>
        </div>

        <div class="input-data">
          <label for="password">Hasło</label>
          <input type="password" name="password" id="password"/>
        </div>

        <div class="input-data">
          <label for="repeatpassword">Powtórz hasło</label>
          <input type="password" name="repeatpassword" id="repeatpassword"/>
        </div>
        <div class="buttons-container">
          <input class="modal-buttons" type="submit" value="Zarejestruj się" />
          <button type="button" class="modal-buttons" id="modal_close_sign">Zamknij</button>
        </div>
      </form>
    </div>
    <footer>
      <p>Projekt wykonany na przedmiot PWI. Autor: Piotr Chłopski</p>
    </footer>
    <script src="js/script.js"></script>
    
  </body>
</html>
