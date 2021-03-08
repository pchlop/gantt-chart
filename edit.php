<?php
  session_start();
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


<div class='project-view'>
  <div>
    <?php
    if(isset($_SESSION['project_name']))
    {
      echo "Edycja projektu: ".$_SESSION['project_name'];
    }
    else {
      echo "Edytuj wybrany projekt!";
    }
    ?>
  </div>
  <div class='vpbuttons'>
    <a href="#" id="add_task" class="vpbutton">DODAJ ZADANIE</a>
  </div>
  
</div>

<?php
echo "<div style='color:red'>";
    if(isset($_SESSION['e_projectname']))
        echo $_SESSION['e_projectname'];
      unset($_SESSION['e_projectname']);
      echo "</div>"
  ?>


    

    <div id="addtask_modal" class="container hidden">
      <div class="text">Dodaj zadanie</div>
      <form action="db/addtask.php" method="post">
        <div class="input-data">
          <label for="taskname">Nazwa zadania</label>
          <input type="text" name="taskname" id="taskname" />
        </div>

        <div class="input-data">
          <label for="starttask">Początek zadania</label>
          <input type="date" name="starttask" id="starttask" />
        </div>

        <div class="input-data">
          <label for="endtask">Koniec zadania</label>
          <input type="date" name="endtask" id="endtask" />
        </div>

        <div class="buttons-container">
          <input class="modal-buttons" type="submit" value="Dodaj zadanie" />
          <button type="button" class="modal-buttons" id="modal_close">Zamknij</button>
        </div>
      </form>
    </div>

    <div id="edittask_modal" class="container hidden">
      <div class="text">Edytuj zadanie</div>
      <form action="db/edittask.php" method="post">
        <div class="input-data">
          <label for="etaskname">Nazwa zadania</label>
          <input type="text" name="etaskname" id="etaskname" />
        </div>

        <div class="input-data">
          <label for="estarttask">Początek zadania</label>
          <input type="date" name="estarttask" id="estarttask" />
        </div>

        <div class="input-data">
          <label for="eendtask">Koniec zadania</label>
          <input type="date" name="eendtask" id="eendtask" />
        </div>

        <div class="buttons-container">
          <input class="modal-buttons" type="submit" value="Edytuj zadanie" />
          <button type="button" class="modal-buttons" id="edit_modal_close">Zamknij</button>
        </div>
      </form>
    </div>
    
    <?php

        include "db/taskviewer.php";
    ?>
    <script>

let add_task = document.getElementById("add_task");
let modal_close = document.getElementById("modal_close");
let edit_modal_close = document.getElementById("edit_modal_close");
let editform = document.querySelector("form[action='db/edittask.php']")

add_task.addEventListener("click", function() {
let addtask_modal = document.getElementById("addtask_modal");
addtask_modal.classList.remove("hidden");
})

edittask_modal = document.getElementById("edittask_modal");
let edittask = document.getElementsByClassName('edittask');
for(let i=0;i<edittask.length;i++){
  edittask[i].addEventListener("click", function() {
  edittask_modal.classList.remove("hidden");
  console.log(editform.action);
  editform.action = editform.action + "?id=" + edittask[i].id;
  console.log(editform.action);
})}

modal_close.addEventListener("click", function() {
let addtask_modal = document.getElementById("addtask_modal");
addtask_modal.classList.add("hidden");
})

edit_modal_close.addEventListener("click", function() {
let edittask_modal = document.getElementById("edittask_modal");
edittask_modal.classList.add("hidden");
})
;

</script>

    </body>