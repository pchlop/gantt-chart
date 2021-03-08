<?php

    session_start();

    require_once "db_data.php";

    $project_name = $_POST['projectname'];

    if(strlen($project_name) < 2 || strlen($project_name) > 40)
        {
            $_SESSION['e_projectname'] = "Nazwa projektu musi zawierać od 2 do 40 znaków";
            header('Location: ../welcome.php');
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
                $project_name = mysqli_real_escape_string($connect, htmlspecialchars($project_name));
                $user_id = $_SESSION['user_id'];
                $result = $connect->query("SELECT id_projektu FROM projekty WHERE (nazwa='$project_name') and (wlasciciel = '$user_id')");
				
				if (!$result) throw new Exception($polaczenie->error);
				
				$how_projects = $result->num_rows;
				if($how_projects>0)
				{
                    $_SESSION['projectexist'] = "Istnieje już projekt o takiej nazwie!";
                    header('Location: ../welcome.php');
                }
                else
                {
                    $user_id = $_SESSION['user_id'];
                    $query = "INSERT INTO projekty (nazwa, wlasciciel) VALUES ('$project_name', $user_id)";

                    if($connect->query($query))
                    {
                        $_SESSION['add'] = "Udało się dodać projekt";
                        header('Location: ../welcome.php');
                    }
                    else
                    {
                        throw new Exception($connect->error);
                    }

                }

                $connect->close();
            }
        }
        catch(Exception $e)
        {
            echo 'Błąd bazy danych';
        }
    }
?>