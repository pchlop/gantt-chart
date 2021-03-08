<?php
        session_start();

        require_once "db_data.php";
    
        $add_tast_name = $_POST['taskname'];
        $add_task_start = $_POST["starttask"];
        //$add_task_start = date('Y-m-d', $add_task_start); 
        $add_task_end = $_POST["endtask"];
        //$add_task_end = date('Y-m-d', $add_task_end); 
        $in_project = $_SESSION['project_id'];

        if(strlen($add_tast_name) < 2 || strlen($add_tast_name) > 40)
        {
            $_SESSION['e_projectname'] = "Nazwa zadania musi zawierać od 2 do 40 znaków";
            header('Location: ../edit.php');
        }
        elseif($add_task_start > $add_task_end) {
            $_SESSION['e_projectname'] = "Złe daty";
            header('Location: ../edit.php');
        }

        else
        {
        try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connect->connect_errno!=0) 
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {   
                $add_tast_name = mysqli_real_escape_string($connect, htmlspecialchars($add_tast_name));
                $query = "INSERT INTO zadania (nazwa, startzadania, konieczadania, wprojekcie)
                VALUES
                ('$add_tast_name', '$add_task_start', '$add_task_end', $in_project)";

                    if($connect->query($query))
                    {
                        $_SESSION['e_projectname'] = "Dodano zadanie!";
                        header('Location: ../edit.php');
                    }
                    else
                    {
                        throw new Exception($connect->error);
                        header('Location: ../index.php');
                    }
                $connect->close();
            }
        }
        catch(Exception $e)
        {
            echo 'Błąd bazy danych';
            echo $e;

        }
    }
?>
