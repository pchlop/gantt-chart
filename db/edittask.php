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
                $task_id = $_GET['id'];
                $taskname = $_POST['etaskname'];
                $starttask = $_POST['estarttask'];
                $endtask = $_POST['eendtask'];
                $query = "update zadania set nazwa = '$taskname', startzadania = '$starttask', konieczadania = '$endtask' where id_zadania = $task_id";
                if($connect->query($query))
                {
                    echo "Udana edycja";
                    header('Location: ../edit.php');
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