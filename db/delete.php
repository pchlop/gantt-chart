<?php

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
                $project_id = $_GET['id'];
                $query = "delete from projekty where id_projektu = $project_id";
                $query2 = "delete from zadania where wprojekcie = $project_id";
                $connect->query($query2);
                if($connect->query($query))
                {
                    echo "Usunięto projekt";
                    header('Location: ../welcome.php');
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