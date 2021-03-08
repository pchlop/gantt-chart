<?php

    //session_start();

    require_once "db_data.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connect->connect_errno!=0) 
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM projekty WHERE wlasciciel = $user_id";
                if($connect->query($query))
                {
                    //echo "Zapytanie pobrania danych udało się";
                    $result = $connect->query($query);
                    $hrows = $result->num_rows;

                    if ($hrows > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<div class='project-view'>";
                            echo "<div>".$row['nazwa']."</div>";
                            echo "<div class='vpbuttons'>";
                            echo "<a href='db/delete.php?id=".$row['id_projektu']."' class='vpbutton'>USUŃ</a>";
                            echo "<a href='edit.php?id=".$row['id_projektu']."' class='vpbutton'>EDYTUJ</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
                else
                {
                    throw new Exception($connect->error);
                }
            }
        $connect->close();
        }

    catch(Exception $e)
    {
        echo 'Błąd bazy danych';
        echo $connect->errno;
    }
?>