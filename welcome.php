<?php
    session_start();

    if(!(isset($_SESSION['login'])))
    header("Location: index.php");
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
        <?php

        echo "<h1>";
        echo $_SESSION['firstname']." ".$_SESSION['lastname'].", witaj w aplikacji Wykresy Gantta";
        echo "</h1>";
        
        ?>
      </div>
    </header>
    <main>
      <div class="buttons">
        <a href="#" id="add_project" class="button">Utwórz nowy wykres gantta</a>
      </div>
    </main>

    <div id="addproject_modal" class="container hidden">
      <div class="text">Nowy projekt</div>
      <form action="db/addproject.php" method="post">
        <div class="input-data">
          <label for="projectname">Nazwa projektu</label>
          <input type="text" name="projectname" id="projectname" />
        </div>

        <div class="buttons-container">
          <input class="modal-buttons" type="submit" value="Utwórz wykres" />
          <button type="button" class="modal-buttons" id="modal_close">Zamknij</button>
        </div>
      </form>
    </div>

    <?php
          if(isset($_SESSION['e_projectname']))
          echo $_SESSION['e_projectname'];
          unset($_SESSION['e_projectname']);
      
          if(isset($_SESSION['projectexist']))
          echo $_SESSION['projectexist'];
          unset($_SESSION['projectexist']);
      
          if(isset($_SESSION['add']))
          echo $_SESSION['add'];
          unset($_SESSION['add']);
    ?>
    
    <?php

      include "db/viewproject.php";

      ?>

    

    <footer>
    <p>Projekt wykonany na przedmiot PWI. Autor: Piotr Chłopski</p>
    </footer>
    <script>

        let add_project = document.getElementById("add_project");
        let modal_close = document.getElementById("modal_close");

        add_project.addEventListener("click", function() {
        let addproject_modal = document.getElementById("addproject_modal");
        addproject_modal.classList.remove("hidden");
        })

        modal_close.addEventListener("click", function() {
        let addproject_modal = document.getElementById("addproject_modal");
        addproject_modal.classList.add("hidden");
        })

    
    </script>
  </body>
</html>
