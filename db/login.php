<?php

    session_start();

    require_once "db_data.php";

    $loggedin = false;

    $connect = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connect->connect_errno!=0) {
        echo "Błąd: ".$connect->connect_errno;
    }
    else {
        //echo "Połączono z bazą";
        $login = $_POST['loginusername'];
        $pass = $_POST['loginpassword'];
        $salt1 = "ala";
        $salt2 = "makota";

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");


        $query = sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
        mysqli_real_escape_string($connect, $login));

        if ($result = $connect->query($query)) {
            $howrows = $result->num_rows;
    
            if($howrows>0) {
                $row = $result->fetch_assoc();

                if (password_verify(($salt1.$pass.$salt2),$row['haslo'])) 
                {
                $_SESSION['loggedin'] = true;
                $loggedin = true;
                $_SESSION['user_id'] = $row['id_uzytkownika'];
                $_SESSION['firstname'] = $row['imie'];
                $_SESSION['lastname'] = $row['nazwisko'];
                $_SESSION['login'] = $row['login'];
                /*
                echo $_SESSION['id_uzytkownika'];
                echo $_SESSION['imie'];
                echo $_SESSION['nazwisko'];
                echo $_SESSION['login'];
                */
               
                header('Location: ../welcome.php');
                }
                else 
                {
                    $_SESSION['login_error'] = 'Niepoprawne hasło lub nazwa użytkownika. Spróbuj ponownie.';
                    
                    header('Location: ../index.php');
                }
            }

            else {
                $_SESSION['login_error'] = 'Niepoprawne hasło lub nazwa użytkownika. Spróbuj ponownie.';
                
                header('Location: ../index.php');
            }
        }

        $connect->close();
    }
    //echo $loggedin ? "OK" : "NOK";
?>